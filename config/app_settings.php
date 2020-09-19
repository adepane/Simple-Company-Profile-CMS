<?php

return [

    // All the sections for the settings page
    'sections' => [
        'app' => [
            'title' => 'General Settings',
            'descriptions' => 'Application general settings.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'title', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Title', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Judul Situs', // placeholder for input
                    'rules' => 'max:60', // validation rules for this input
                ],
                [
                    'name' => 'tagline', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Tagline', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Tagline Situs', // placeholder for input
                    'rules' => 'max:50', // validation rules for this input
                ],
                [
                    'name' => 'description', // unique key for setting
                    'type' => 'textarea', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Meta Deskripsi', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Deskripsi Situs', // placeholder for input
                    'rules' => 'max:300', // validation rules for this input
                ],
                [
                    'name' => 'keywords', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Meta Keyword', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Keyword Situs (Pisahkan dengan koma)', // placeholder for input
                    'rules' => 'max:300', // validation rules for this input
                ],
                [
                    'name' => 'logo',
                    'type' => 'image',
                    'label' => 'Logo',
                    'hint' => 'Must be an image and cropped in desired size',
                    'rules' => 'image|max:500',
                    'disk' => 'settingfile', // which disk you want to upload
                    'path' => 'files', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:40px'
                ],
                [
                    'name' => 'logo_footer',
                    'type' => 'image',
                    'label' => 'Footer Logo',
                    'hint' => 'Must be an image and cropped in desired size',
                    'rules' => 'image|max:500',
                    'disk' => 'settingfile', // which disk you want to upload
                    'path' => 'files', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:40px'
                ],
                [
                    'name' => 'favicon',
                    'type' => 'image',
                    'label' => 'Upload Favicon',
                    'hint' => 'Must be an image and cropped in desired size',
                    'rules' => 'image|max:50',
                    'disk' => 'settingfile', // which disk you want to upload
                    'path' => 'files', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:30px'
                ],
                [
                    'name' => 'address', // unique key for setting
                    'type' => 'textarea', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Alamat', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Alamat', // placeholder for input
                    'rules' => 'max:300', // validation rules for this input
                ],
                [
                    'name' => 'phone', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Telp.', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Nomor Telp.', // placeholder for input
                    'rules' => 'max:15', // validation rules for this input
                ],
                [
                    'name' => 'email', // unique key for setting
                    'type' => 'email', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Email', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Email.', // placeholder for input
                    'rules' => 'max:25', // validation rules for this input
                ],
                [
                    'name' => 'website', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Website', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan domain.', // placeholder for input
                    'rules' => 'max:25', // validation rules for this input
                ],
                [
                    'name' => 'facebook', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Facebook', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Alamat Profile / Fans Page Facebook.', // placeholder for input
                    'rules' => 'max:50', // validation rules for this input
                ],
                [
                    'name' => 'instagram', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Instagram', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Alamat Instagram', // placeholder for input
                    'rules' => 'max:50', // validation rules for this input
                ],
                [
                    'name' => 'twitter', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Twitter', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Alamat Twitter', // placeholder for input
                    'rules' => 'max:50', // validation rules for this input
                ],
                [
                    'name' => 'yt_channel', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Youtube Channel', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Alamat Youtube Channel', // placeholder for input
                    'rules' => 'max:100', // validation rules for this input
                ],
                [
                    'name' => 'googleanalytics', // unique key for setting
                    'type' => 'textarea', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Google Analytic Script', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan Script Google Analytics', // placeholder for input
                ],
            ]
        ],
        'front' => [
            'title' => 'Front Index Settings',
            'descriptions' => 'Application Front Index settings.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'ix_slider', // unique key for setting
                    'type' => 'number', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Number of Slideshow', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan total index Slide', // placeholder for input
                    'rules' => 'max:50', // validation rules for this input
                ],
                [
                    'name' => 'ix_berita', // unique key for setting
                    'type' => 'number', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Number of News', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan total index berita', // placeholder for input
                    'rules' => 'max:50', // validation rules for this input
                ],
                [
                    'name' => 'ix_agenda', // unique key for setting
                    'type' => 'number', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Number of Event', // label for input
                    // optional properties
                    'placeholder' => 'Masukkan total index Agenda', // placeholder for input
                    'rules' => 'max:50', // validation rules for this input
                ],
                
            ]
        ],
        'blogpost' => [
            'title' => 'Blog Index Settings',
            'descriptions' => 'Application Blog Index settings.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'defaultimage',
                    'type' => 'image',
                    'label' => 'Logo',
                    'hint' => 'Must be an image and cropped in desired size',
                    'rules' => 'image|max:500',
                    'disk' => 'settingfile', // which disk you want to upload
                    'path' => 'files', // path on the disk,
                    'preview_class' => 'thumbnail',
                    'preview_style' => 'height:40px'
                ],
                
            ]
        ]
    ],

    // Setting page url, will be used for get and post request
    'url' => '/panelroom/settings',

    // Any middleware you want to run on above route
    'middleware' => ['auth'],

    // View settings
    // 'setting_page_view' => 'app_settings::settings_page',
    'setting_page_view' => 'setting.index',
    'flash_partial' => 'app_settings::_flash',

    // Setting section class setting
    'section_class' => 'mb-3',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group row',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Save Settings',
    'submit_success_message' => 'Settings has been saved.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting

    // settings group
    // 'setting_group' => function() {
    //     // return 'user_'.auth()->id();
    //     return 'default';
    // }
];
