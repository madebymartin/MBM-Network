<?php
$layout_version = '1.0.0';

if (file_exists(get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'global-regions' . DIRECTORY_SEPARATOR . 'header.php')) include(get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'global-regions' . DIRECTORY_SEPARATOR . 'header.php');

$cases_region = upfront_create_region(
			array (
  'name' => 'cases_region',
  'title' => 'Cases Region',
  'type' => 'wide',
  'scope' => 'local',
  'container' => 'cases_region',
  'position' => 1,
  'allow_sidebar' => true,
),
			array (
  'row' => 15,
  'background_type' => 'color',
  'background_color' => '#ufc0',
  'nav_region' => '',
  'breakpoint' =>
  (array)(array(
     'tablet' =>
    (array)(array(
       'edited' => true,
       'col' => 24,
       'row' => 63,
       'background_type' => 'color',
    )),
     'mobile' =>
    (array)(array(
       'edited' => true,
       'row' => 178,
       'background_type' => 'color',
       'bottom_bg_padding_slider' => '60',
       'bottom_bg_padding_num' => '60',
    )),
     'custom-1410783666947' =>
    (array)(array(
       'edited' => true,
       'row' => 344,
    )),
     'current_property' => 'bottom_bg_padding_num',
  )),
  'use_padding' => 0,
  'sub_regions' =>
  array (
    0 => '',
  ),
  'version' => '1.0.0',
  'bg_padding_type' => 'varied',
  'top_bg_padding_slider' => 0,
  'top_bg_padding_num' => 0,
  'bottom_bg_padding_slider' => '105',
  'bottom_bg_padding_num' => '105',
  'bg_padding_slider' => 0,
  'bg_padding_num' => 0,
  'region_role' => 'main',
)
			);

$cases_region->add_element("PlainTxt", array (
  'columns' => '24',
  'margin_left' => '0',
  'margin_right' => '0',
  'margin_top' => '0',
  'margin_bottom' => '0',
  'class' => 'module-1407250114380-1665-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module',
  'id' => 'module-1407250114380-1665-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module',
  'options' =>
  array (
    'view_class' => 'PlainTxtView',
    'id_slug' => 'plain_text',
    'usingNewAppearance' => true,
    'content' => '<h1 class="" style="text-align: center;">Case Study</h1>',
    'type' => 'PlainTxtModel',
    'element_id' => 'text-object-1407250114379-1090',
    'class' => 'c24 upfront-plain_txt',
    'has_settings' => 1,
    'row' => 21,
    'is_edited' => true,
    'border_style' => 'none',
    'border_width' => 1,
    'border_color' => 'rgba(0, 0, 0, 0)',
    'bg_color' => 'rgba(0, 0, 0, 0)',
    'anchor' => '',
    'theme_style' => '',
    'top_padding_use' => 'yes',
    'top_padding_num' => '110',
    'bottom_padding_num' => '15',
    'preset' => 'archive-heading-m',
    'padding_slider' => '15',
    'use_padding' => 'yes',
    'lock_padding' => '',
    'top_padding_slider' => '110',
    'padding_number' => '15',
    'left_padding_num' => '15',
    'right_padding_num' => '15',
    'breakpoint_presets' =>
    (array)(array(
       'desktop' =>
      (array)(array(
         'preset' => 'archive-heading-m',
      )),
       'tablet' =>
      (array)(array(
         'preset' => 'archive-heading-tablet',
      )),
       'mobile' =>
      (array)(array(
         'preset' => 'archive-heading-mobile',
      )),
    )),
    'breakpoint' =>
    (array)(array(
       'mobile' =>
      (array)(array(
         'use_padding' => 'yes',
         'lock_padding' => '',
         'top_padding_use' => 'yes',
         'top_padding_slider' => '50',
         'top_padding_num' => '50',
         'row' => 13,
      )),
       'current_property' => 'use_padding',
    )),
    'current_preset' => 'archive-heading-m',
  ),
  'row' => 6,
  'sticky' => false,
  'default_hide' => 0,
  'hide' => 0,
  'toggle_hide' => 1,
  'wrapper_id' => 'module-1407250114380-1665-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-wrapper',
  'new_line' => true,
  'wrapper_breakpoint' =>
  array (
    'tablet' =>
    array (
      'col' => 12,
      'order' => 1,
      'clear' => true,
    ),
    'mobile' =>
    array (
      'col' => 7,
      'order' => 1,
      'clear' => true,
    ),
    'custom-1410783666947' =>
    array (
      'col' => 18,
      'order' => 0,
    ),
    'current_property' =>
    array (
      0 => 'order',
    ),
  ),
  'breakpoint' =>
  array (
    'tablet' =>
    array (
      'edited' => false,
      'left' => 0,
      'col' => 12,
      'order' => 0,
      'top' => 0,
    ),
    'mobile' =>
    array (
      'edited' => true,
      'left' => 0,
      'col' => 7,
      'order' => 0,
      'top' => 0,
      'row' => 13,
    ),
    'custom-1410783666947' =>
    array (
      'edited' => false,
      'left' => 0,
      'col' => 18,
      'order' => 0,
    ),
    'current_property' =>
    array (
      0 => 'col',
    ),
  ),
));

$cases_region->add_element("PlainTxt", array (
  'columns' => '24',
  'margin_left' => '0',
  'margin_right' => '0',
  'margin_top' => '0',
  'margin_bottom' => '0',
  'class' => 'module-1407250139415-1897-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module',
  'id' => 'module-1407250139415-1897-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module',
  'options' =>
  array (
    'view_class' => 'PlainTxtView',
    'id_slug' => 'plain_text',
    'usingNewAppearance' => true,
    'content' => '<h2 class="" style="text-align: center;">Issue Resolved!</h2>',
    'type' => 'PlainTxtModel',
    'element_id' => 'text-object-1407250139414-1484',
    'class' => 'c24 upfront-plain_txt',
    'has_settings' => 1,
    'row' => 4,
    'is_edited' => true,
    'border_style' => 'none',
    'border_width' => 1,
    'border_color' => '',
    'bg_color' => '',
    'anchor' => '',
    'top_padding_num' => '15',
    'bottom_padding_num' => '15',
    'preset' => 'archive-heading-m',
    'theme_style' => '',
    'use_padding' => 'yes',
    'lock_padding' => '',
    'padding_slider' => '15',
    'padding_number' => '15',
    'left_padding_num' => '15',
    'right_padding_num' => '15',
    'breakpoint' =>
    (array)(array(
       'mobile' =>
      (array)(array(
         'row' => 21,
      )),
    )),
    'breakpoint_presets' =>
    (array)(array(
       'desktop' =>
      (array)(array(
         'preset' => 'archive-heading-m',
      )),
       'tablet' =>
      (array)(array(
         'preset' => 'archive-heading-tablet',
      )),
       'mobile' =>
      (array)(array(
         'preset' => 'archive-heading-mobile',
      )),
    )),
    'current_preset' => 'archive-heading-m',
  ),
  'row' => 6,
  'sticky' => false,
  'default_hide' => 0,
  'hide' => 0,
  'toggle_hide' => 1,
  'wrapper_id' => 'module-1407250139415-1897-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-wrapper',
  'new_line' => true,
  'wrapper_breakpoint' =>
  array (
    'tablet' =>
    array (
      'col' => 12,
      'order' => 2,
      'clear' => true,
    ),
    'mobile' =>
    array (
      'col' => 7,
      'order' => 2,
      'clear' => true,
    ),
    'custom-1410783666947' =>
    array (
      'col' => 18,
      'order' => 0,
    ),
    'current_property' =>
    array (
      0 => 'order',
    ),
  ),
  'breakpoint' =>
  array (
    'tablet' =>
    array (
      'edited' => false,
      'left' => 0,
      'col' => 12,
      'order' => 0,
      'top' => 0,
    ),
    'mobile' =>
    array (
      'edited' => true,
      'left' => 0,
      'col' => 7,
      'order' => 0,
      'top' => 0,
      'row' => 21,
    ),
    'custom-1410783666947' =>
    array (
      'edited' => false,
      'left' => 0,
      'col' => 18,
      'order' => 0,
    ),
    'current_property' =>
    array (
      0 => 'col',
    ),
  ),
));

$cases_region->add_element("Ugallery", array (
  'columns' => '24',
  'margin_left' => '0',
  'margin_right' => '0',
  'margin_top' => '0',
  'margin_bottom' => '0',
  'class' => 'module-1407250114394-1623-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module',
  'id' => 'module-1407250114394-1623-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module',
  'options' =>
  array (
    'type' => 'UgalleryModel',
    'view_class' => 'UgalleryView',
    'has_settings' => 1,
    'class' => 'c24 upfront-gallery',
    'id_slug' => 'ugallery',
    'preset' => 'case-study-ugallery-style-m',
    'status' => 'ok',
    'images' =>
    array (
      0 =>
      (array)(array(
         'id' => '4009',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image3-210x210-1861.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image3.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image3-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image3.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image3.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image3.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image3-210x210-1861.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image3.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4009,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image3.jpg',
         'title' => 'Image caption',
         'caption' => '<p>This is Case</p>',
         'alt' => '',
         'tags' =>
        array (
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => 'image',
           'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image3.jpg',
           'target' => '_self',
        )),
         'linkTarget' => '_self',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => 'image',
         'imageLinkType' => 'image',
         'imageLinkUrl' => '{{upfront:style_url}}/images/single-page-cases/gal-image3.jpg',
         'imageLinkTarget' => '_self',
      )),
      1 =>
      (array)(array(
         'id' => '4010',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image4-210x210-4359.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image4.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image4-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image4.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image4.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image4.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image4-210x210-4359.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image4.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4010,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Roofing',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      2 =>
      (array)(array(
         'id' => '4011',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image5-210x210-4712.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image5.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image5-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image5.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image5.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image5.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image5-210x210-4712.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image5.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4011,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Plumping',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      3 =>
      (array)(array(
         'id' => '4012',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image6-210x210-4674.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image6.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image6-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image6.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image6.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image6.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image6-210x210-4674.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image6.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4012,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Roofing',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      4 =>
      (array)(array(
         'id' => '4014',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image7-210x210-4688.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image7.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image7-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image7.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image7.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image7.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image7-210x210-4688.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image7.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4014,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Roofing',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      5 =>
      (array)(array(
         'id' => '4015',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image8-210x210-3938.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image8.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image8-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image8.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image8.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image8.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image8-210x210-3938.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image8.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4015,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Plumping',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      6 =>
      (array)(array(
         'id' => '4017',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image9-210x210-3034.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image9.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image9-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image9.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image9.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image9.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image9-210x210-3034.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image9.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4017,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Plumping',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      7 =>
      (array)(array(
         'id' => '4019',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image10-210x210-8979.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image10.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image10-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image10.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image10.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image10.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image10-210x210-8979.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image10.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4019,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Plumping',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      8 =>
      (array)(array(
         'id' => '4021',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image11-210x210-3368.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image11.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image11-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image11.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image11.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image11.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image11-210x210-3368.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image11.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4021,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Plumping',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      9 =>
      (array)(array(
         'id' => '4023',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image12-210x210-4128.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image12.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image12-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image12.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image12.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image12.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image12-210x210-4128.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image12.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4023,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Roofing',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      10 =>
      (array)(array(
         'id' => '4024',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image13-210x210-6797.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image13.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image13-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image13.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image13.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image13.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image13-210x210-6797.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image13.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4024,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Plumping',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      11 =>
      (array)(array(
         'id' => '4027',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image15-210x210-3561.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image15.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image15-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image15.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image15.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image15.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image15-210x210-3561.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image15.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4027,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Roofing',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      12 =>
      (array)(array(
         'id' => '4029',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image14-210x210-8695.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image14.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image14-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image14.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image14.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image14.jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image14-210x210-8695.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image14.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4029,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Plumping',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      13 =>
      (array)(array(
         'id' => '4007',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image1-210x210-7027.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image1.jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image1-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image1.jpg',
            1 => 210,
            2 => 213,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image1.jpg',
            1 => 210,
            2 => 213,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image1.jpg',
            1 => 210,
            2 => 213,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image1-210x210-7027.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image1.jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 213,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 1,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 213,
              )),
               'id' => 4007,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 213,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 1,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
          0 => 'All',
          1 => 'Plumping',
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
      14 =>
      (array)(array(
         'id' => '4035',
         'src' => '{{upfront:style_url}}/images/single-page-cases/gal-image11 (1)-210x210-2311.jpg',
         'srcFull' => '{{upfront:style_url}}/images/single-page-cases/gal-image11 (1).jpg',
         'sizes' =>
        (array)(array(
           'thumbnail' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image11 (1)-150x150.jpg',
            1 => 150,
            2 => 150,
            3 => true,
          ),
           'medium' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image11 (1).jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'large' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image11 (1).jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'full' =>
          array (
            0 => '{{upfront:style_url}}/images/single-page-cases/gal-image11 (1).jpg',
            1 => 210,
            2 => 210,
            3 => false,
          ),
           'custom' =>
          (array)(array(
             'error' => false,
             'url' => '{{upfront:style_url}}/images/single-page-cases/gal-image11 (1)-210x210-2311.jpg',
             'urlOriginal' => '{{upfront:style_url}}/images/single-page-cases/gal-image11 (1).jpg',
             'full' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'crop' =>
            (array)(array(
               'width' => 210,
               'height' => 210,
            )),
             'editdata' =>
            (array)(array(
               'rotate' => 0,
               'crop' =>
              (array)(array(
                 'width' => '210',
                 'height' => '210',
                 'left' => 0,
                 'top' => 0,
              )),
               'resize' =>
              (array)(array(
                 'width' => 210,
                 'height' => 210,
              )),
               'id' => 4035,
               'element_id' => 'ugallery-object-1407250114391-1191',
            )),
          )),
        )),
         'size' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropSize' =>
        (array)(array(
           'width' => 210,
           'height' => 210,
        )),
         'cropOffset' =>
        (array)(array(
           'width' => '210',
           'height' => '210',
           'left' => 0,
           'top' => 0,
        )),
         'rotation' => 0,
         'link' => 'original',
         'url' => '',
         'title' => 'Image caption',
         'caption' => 'Image description',
         'alt' => '',
         'tags' =>
        array (
        ),
         'margin' =>
        (array)(array(
           'left' => 0,
           'top' => 0,
        )),
         'imageLink' =>
        (array)(array(
           'type' => false,
           'url' => '',
           'target' => '',
        )),
         'linkTarget' => '',
         'loading' => false,
         'status' => 'ok',
         'element_id' => 'ugallery-object-1407250114391-1191',
         'urlType' => false,
         'imageLinkType' => 'image',
         'imageLinkUrl' => '',
         'imageLinkTarget' => '',
      )),
    ),
    'elementSize' =>
    (array)(array(
       'width' => 0,
       'height' => 0,
    )),
    'labelFilters' => 'true',
    'thumbProportions' => '1',
    'thumbWidth' => '210',
    'thumbHeight' => 210,
    'thumbWidthNumber' => '210',
    'captionType' => 'none',
    'captionColor' => '#ufc0',
    'captionUseBackground' => 0,
    'captionBackground' => '#000000',
    'showCaptionOnHover' =>
    array (
      0 => 'true',
    ),
    'fitThumbCaptions' => false,
    'thumbCaptionsHeight' => 20,
    'linkTo' => 'image',
    'even_padding' =>
    array (
      0 => 'true',
    ),
    'thumbPadding' => 0,
    'sidePadding' => 0,
    'bottomPadding' => 0,
    'thumbPaddingNumber' => 0,
    'thumbSidePaddingNumber' => 0,
    'thumbBottomPaddingNumber' => 0,
    'lockPadding' => '',
    'lightbox_show_close' =>
    array (
      0 => 'true',
    ),
    'lightbox_show_image_count' =>
    array (
      0 => 'true',
    ),
    'lightbox_click_out_close' =>
    array (
      0 => 'true',
    ),
    'lightbox_active_area_bg' => 'rgba(255,255,255,1)',
    'lightbox_overlay_bg' => 'rgba(0,0,0,0.2)',
    'styles' => '',
    'usingNewAppearance' => true,
    'captionPosition' => 'below',
    'captionWhen' => 'never',
    'no_padding' =>
    array (
      0 => 'true',
    ),
    'element_id' => 'ugallery-object-1407250114391-1191',
    'theme_style' => '',
    'anchor' => '',
    'top_padding_use' => true,
    'top_padding_num' => 70,
    'bottom_padding_num' => '0',
    'use_padding' => 'yes',
    'lock_padding' => '',
    'padding_slider' => 'false',
    'padding_number' => 0,
    'left_padding_num' => '15',
    'right_padding_num' => '15',
    'thumbSidePadding' => 0,
    'bottom_padding_use' => 'yes',
    'bottom_padding_slider' => '0',
    'breakpoint_presets' =>
    array (
    ),
    'current_preset' => 'case-study-ugallery-style-m',
  ),
  'row' => 6,
  'sticky' => false,
  'default_hide' => 0,
  'hide' => 0,
  'toggle_hide' => 1,
  'wrapper_id' => 'module-1407250114394-1623-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-module-wrapper',
  'new_line' => true,
  'wrapper_breakpoint' =>
  array (
    'tablet' =>
    array (
      'col' => 12,
      'order' => 3,
      'clear' => true,
    ),
    'mobile' =>
    array (
      'col' => 7,
      'order' => 3,
      'clear' => true,
    ),
    'custom-1410783666947' =>
    array (
      'col' => 18,
      'order' => 0,
    ),
    'current_property' =>
    array (
      0 => 'order',
    ),
  ),
  'breakpoint' =>
  array (
    'tablet' =>
    array (
      'edited' => false,
      'left' => 0,
      'col' => 12,
      'order' => 0,
      'top' => 0,
    ),
    'mobile' =>
    array (
      'edited' => false,
      'left' => 0,
      'col' => 7,
      'order' => 0,
      'top' => 0,
    ),
    'custom-1410783666947' =>
    array (
      'edited' => false,
      'left' => 0,
      'col' => 18,
      'order' => 0,
    ),
    'current_property' =>
    array (
      0 => 'col',
    ),
  ),
));

$regions->add($cases_region);

if (file_exists(get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'global-regions' . DIRECTORY_SEPARATOR . 'prefooter.php')) include(get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'global-regions' . DIRECTORY_SEPARATOR . 'prefooter.php');

if (file_exists(get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'global-regions' . DIRECTORY_SEPARATOR . 'footer.php')) include(get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'global-regions' . DIRECTORY_SEPARATOR . 'footer.php');
