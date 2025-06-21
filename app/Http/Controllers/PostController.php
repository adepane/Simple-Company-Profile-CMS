<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * YouTube URL validation regex pattern
     */
    private const YOUTUBE_REGEX = '#https?://(?:www\.)?youtube\.com/watch\?v=([^&]+?)#';

    /**
     * Post model instance
     */
    private Post $postModel;

    /**
     * Constructor with dependency injection
     */
    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * Generate a unique slug for the post
     *
     * @param  string  $slug  Base slug to check
     * @param  int  $id  Post ID (for updates)
     * @param  string|null  $oldSlug  Previous slug (for updates)
     * @return string Unique slug
     */
    public function generateUniqueSlug(string $slug, int $id = 0, ?string $oldSlug = null): string
    {
        $slugCount = $this->postModel
            ->query()
            ->select('slug')
            ->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->count();

        // If no similar slugs exist, return the original slug
        if ($slugCount === 0) {
            return $slug;
        }

        // For existing posts being updated
        if ($id > 0 && $oldSlug) {
            // If the old slug contains the new slug base
            if (Str::contains($oldSlug, $slug)) {
                $existingPost = $this->postModel->query()->find($id);
                // If the stored slug matches the old slug, keep using it
                if ($existingPost && $existingPost->slug === $oldSlug) {
                    return $oldSlug;
                }
            }
        }

        // Generate a new unique slug by appending a number
        return $slug.'-'.($slugCount + 1);
    }

    /**
     * Display a listing of posts
     */
    public function index(): View
    {
        $posts = $this->postModel->query()
            ->select([
                'id',
                'title',
                'slug',
                'author',
                'category_id',
                'status',
                'view',
                'created_at',
                'updated_at',
            ])
            ->with(['kategories', 'authors', 'tags'])
            ->orderBy('publish_date', 'desc')
            ->paginate(10)
            ->onEachSide(2);

        return view('panel.post.index', ['data' => $posts]);
    }

    /**
     * Show the form for creating a new post
     */
    public function create(): View
    {
        return view('panel.post.create');
    }

    /**
     * Get validation rules for post
     */
    protected function getValidationRules(): array
    {
        return [
            'yt_video' => 'nullable|regex:'.self::YOUTUBE_REGEX,
            'file_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    /**
     * Get validation messages for post
     */
    protected function getValidationMessages(): array
    {
        return [
            'file_gambar.image' => 'File gambar tidak valid',
            'yt_video.regex' => 'Link Youtube Salah',
        ];
    }

    /**
     * Store a newly created post in storage
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, $this->getValidationRules(), $this->getValidationMessages());

        // Generate a basic slug
        $baseSlug = Str::slug($request->title);

        // Check if the slug exists
        $slugCount = $this->postModel->query()->where('slug', 'like', $baseSlug.'%')->count();
        $uniqueSlug = $slugCount > 0 ? $baseSlug.'-'.($slugCount + 1) : $baseSlug;

        // Create post with mass assignment
        $post = $this->postModel->query()
            ->create([
                'title' => $request->input('title'),
                'slug' => $uniqueSlug,
                'content' => $request->input('content'),
                'author' => Auth::id(),
                'category_id' => $request->input('kategori'),
                'media_id' => $request->input('id_media'),
                'ket_photo' => $request->input('ket_gambar'),
                'yt_video' => $request->input('yt_video'),
                'publish_date' => $request->input('publish_date') ? Carbon::parse($request->input('publish_date')) : Carbon::now(),
                'status' => $request->input('status'),
            ]);

        if ($post) {
            if ($request->tags) {
                $post->tags()->attach($request->tags);
            }

            return redirect()->route('post.index')->with('message', 'Post telah ditambah');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan post');
    }

    /**
     * Show the form for editing the specified post
     */
    public function edit(int $id): View
    {
        $post = $this->postModel->query()->findOrFail($id);
        $tags = $this->getTags($id);

        return view('panel.post.edit', [
            'data' => $post,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified post in storage
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->validate($request, $this->getValidationRules(), $this->getValidationMessages());

        $post = $this->postModel->findOrFail($id);
        $baseSlug = Str::slug($request->title);
        $oldSlug = $post->slug;

        // Determine if we need a new slug
        $needNewSlug = $baseSlug !== Str::slug($post->title);

        // If we need a new slug, generate a unique one
        $slug = $oldSlug;
        if ($needNewSlug) {
            // Check if the new slug exists in other posts
            $slugCount = $this->postModel->query()
                ->where('slug', 'like', $baseSlug.'%')
                ->where('id', '<>', $id)
                ->count();
            $slug = $slugCount > 0 ? $baseSlug.'-'.($slugCount + 1) : $baseSlug;
        }

        // Update post with mass assignment
        $updateData = [
            'title' => $request->input('title'),
            'slug' => $slug,
            'content' => $request->input('content'),
            'author' => Auth::id(),
            'category_id' => (int) $request->input('kategori'),
            'media_id' => (int) $request->input('id_media'),
            'ket_photo' => $request->input('ket_gambar'),
            'yt_video' => $request->input('yt_video'),
            'status' => $request->input('status'),
            'publish_date' => Carbon::parse($request->input('publish_date')),
        ];

        // Update tags
        $post->tags()->detach();
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        if ($post->update($updateData)) {
            return redirect($request->lastState)->with('message', 'Post telah diupdate');
        }

        return redirect()->back()->with('error', 'Gagal mengupdate post');
    }

    /**
     * Remove the specified post from storage
     */
    public function destroy(int $id): RedirectResponse
    {
        $post = $this->postModel->query()->findOrFail($id);
        $post->tags()->detach();

        if ($post->delete()) {
            return redirect()->back()->with('message', 'Post telah dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus post');
    }

    /**
     * Get tags for a post
     */
    public function getTags(int $id): array
    {
        $post = $this->postModel->query()->findOrFail($id);

        return $post->tags->pluck('name', 'id')->all();
    }

    /**
     * Add a new tag
     */
    public function addTags(Request $request): array
    {
        $response = [
            'status' => 0,
            'message' => 'Tag gagal ditambahkan',
            'tagId' => null,
        ];

        $existingTag = Tag::query()->where('name', $request->dataTag)->first();

        if ($existingTag) {
            $response['status'] = 1;
            $response['message'] = 'Tag telah ditambahkan';
            $response['tagId'] = $existingTag->id;

            return $response;
        }

        // Create tag with mass assignment
        $tag = Tag::create([
            'name' => $request->dataTag,
            'slug' => Str::slug($request->dataTag),
        ]);

        if ($tag) {
            $response['status'] = 1;
            $response['message'] = 'Tag telah ditambahkan';
            $response['tagId'] = $tag->id;
        }

        return $response;
    }

    /**
     * Create a quick draft post
     */
    public function quickDraft(Request $request): array
    {
        // Generate a basic slug
        $baseSlug = Str::slug($request->title);

        // Check if the slug exists
        $slugCount = $this->postModel->query()->where('slug', 'like', $baseSlug.'%')->count();
        $uniqueSlug = $slugCount > 0 ? $baseSlug.'-'.($slugCount + 1) : $baseSlug;

        // Create post with mass assignment
        $post = $this->postModel->query()
            ->create([
                'title' => $request->input('title'),
                'slug' => $uniqueSlug,
                'content' => $request->input('content'),
                'author' => Auth::id(),
                'category_id' => $request->input('kategori') ?? 1,
                'publish_date' => $request->input('publish_date') ? Carbon::parse($request->input('publish_date')) : Carbon::now(),
                'status' => 0,
            ]);

        $response = [
            'status' => 0,
            'message' => 'Gagal menyimpan post',
        ];

        if ($post) {
            $response['status'] = 1;
            $response['message'] = 'Post telah disimpan';
        }

        return $response;
    }
}
