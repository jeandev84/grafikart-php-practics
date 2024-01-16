<?php

declare(strict_types = 1);

namespace App\Helper;

use Illuminate\Support\Collection;

class ImageHelper
{

    /**
     * Returns a picture tag serving webp images in a source tag for an image
     *
     * @param int   $src_id    The Image ID
     * @param array $img_attrs
     *                         size      Allows the overriding of the image size, Defaults to large
     *                         property  Allows the overriding of the image property type, Defaults to image
     *                         class     Appends a class to the image tag
     *                         alt       Allows for the overriding of the image's alt tag, Defaults to the image alt, then image's title
     *                         role      Allows for the overriding of the image's role, Defaults to img
     * @param array $data_atts Pass an array of data attributes for use with JS
     * @param array $aria_atts Any aria attributes needed for the image
     *
     * @return string          Returns a formatted picture HTML element with source and img tags
     */
    public static function imgSrcSet(int $src_id, array $img_attrs = [], array $data_atts = [], array $aria_atts = [])
    :string
    {
        $get_img_data = self::imgSrcSetArr($src_id, $img_attrs);

        // Empty array for data attributes return
        $da_return = [];
        $aa_return = [];
        $style_return = [];

        $properties  = $get_img_data['prop'] ?? '';
        $image_class = $img_attrs['class'] ?? '';
        $pic_class   = $img_attrs['pic_class'] ?? '';
        $image_id    = $img_attrs['id'] ?? '';
        $img_style   = $img_attrs['img_style'] ?? '';

        // Image Information
        $source    = $get_img_data['url'] ?? '';
        $src_set   = $get_img_data['src_set'] ?? '';
        $src_sizes = $get_img_data['src_set_sizes'] ?? '';
        $get_webp  = $get_img_data['webp'] ?? '';

        $role_atts = $img_attrs['role'] ?? ($get_img_data['role'] ?? 'img');

        if ($data_atts) {
            $da_return = self::mapDataAtts($data_atts);
        }

        if ($aria_atts) {
            $aa_return = self::mapAriaAtts($aria_atts);
        }

        if ($img_style) {
            $style_return = collect($img_style)
                ->implode(';');
        }

        /**
         * The webp output in a source tag
         */
        $webp_source = $get_webp ? sprintf(
            '<source srcset="%s" sizes="%s" type="image/webp">',
            $get_webp,
            $src_sizes
        ) : '';

        /**
         * The original image output  in a source tag
         */
        $og_source = $src_set ? sprintf(
            '<source srcset="%s" sizes="%s" type="%s">',
            $src_set,
            $src_sizes,
            $get_img_data['img_type'] ?? ''
        ) : '';

        if (isset($get_img_data['img_type']) && strpos($get_img_data['img_type'], 'svg')) {
            return sprintf(
                '<picture %9$s><img src="%1$s" role="%4$s" %2$s property="v:%3$s" %5$s %6$s content="%1$s" %7$s %8$s /></picture>',
                esc_url($source),
                $get_img_data['alt'] ? "alt=\"{$get_img_data['alt']}\"" : '',
                $properties,
                $role_atts,
                $image_class ? "class=\"$image_class\"" : '',
                $image_id ? "id=\"{$image_id}\"" : '',
                implode(' ', $da_return),
                implode(' ', $aa_return),
                $pic_class ? "class=\"$pic_class\"" : '',
            );
        }

        return sprintf(
            '<picture %11$s>%2$s<img src="%1$s" role="%5$s" %3$s property="v:%4$s" %6$s %7$s content="%1$s" %8$s %9$s %10$s/></picture>',
            esc_url($source),
            ($webp_source ?? '') . $og_source,
            isset($get_img_data['alt']) ? "alt=\"{$get_img_data['alt']}\"" : '',
            $properties,
            $role_atts,
            $image_class ? "class=\"$image_class\"" : '',
            $image_id ? "id=\"$image_id\"" : '',
            implode(' ', $da_return),
            implode(' ', $aa_return),
            !empty($style_return) ? "style='$style_return'" : '',
            $pic_class ? "class=\"$pic_class\"" : '',
        );
    }

    /**
     * Function Name: captionImgSrcset
     *
     * @param int   $src_id    The ID of the image
     * @param array $img_attrs Parameters for overrides, size, property, role, alt, caption override
     * @param array $data_atts Adds data attributes to the image tag.
     * @param array $aria_atts Any aria attributes needed for the image
     *
     * @return string
     */
    public static function imgSrcSetCaption(int $src_id, array $img_attrs = [], array $data_atts = [], array $aria_atts = [])
    :string
    {

        $get_img_data = self::imgSrcSetArr($src_id, $img_attrs);

        // Empty array for data attributes return
        $da_return = [];
        $aa_return = [];

        // $img_attrs
        $properties  = $get_img_data['prop'] ?? '';
        $image_class = $img_attrs['class'] ?? '';
        $pic_class   = $img_attrs['pic_class'] ?? '';
        $image_id    = $img_attrs['id'] ?? '';
        $fig_class   = $img_attrs['figure_class'] ?? '';

        // Image Information
        $source    = $get_img_data['url'] ?? '';
        $src_set   = $get_img_data['src_set'] ?? '';
        $src_sizes = $get_img_data['src_set_sizes'] ?? '';
        $src_alt   = $img_attrs['alt'] ?? '';
        $get_webp  = $get_img_data['webp'] ?? '';
        $role_atts = $img_attrs['role'] ?? ($get_img_data['role'] ?? 'img');

        $caption = $img_attrs['caption'] ?? false;

        // Caption
        if ($caption) {
            $caption_text = !is_bool($caption) ? $caption : wp_get_attachment_caption($src_id);

            // The Caption
            $caption = $caption_text ? sprintf(
                '<figcaption class="wp-caption-text %1$s" content="%2$s" property="v:caption"><span>%2$s</span></figcaption>',
                $img_attrs['figcaption'] ?? '',
                html_entity_decode($caption)
            ) : '';
        }

        // Check to see if the caption exists.
        if ($caption && !$src_alt) {
            $src_alt = $caption_text;
        }

        if ($data_atts) {
            $da_return = self::mapDataAtts($data_atts);
        }

        if ($aria_atts) {
            $aa_return = self::mapAriaAtts($aria_atts);
        }

        // Final assembly of image attributes
        $src_attributes = "alt=\"$src_alt\"";

        $webp_source = $get_webp ? sprintf(
            '<source srcset="%s" sizes="%s" type="image/webp">',
            $get_webp,
            $src_sizes
        ) : '';

        $og_source = $src_set ? sprintf(
            '<source srcset="%s" sizes="%s" type="%s">',
            $src_set,
            $src_sizes,
            str_replace('.', '', substr($source, strrpos($source, '.')))
        ) : '';

        if (isset($get_img_data['img_type']) && strpos($get_img_data['img_type'], 'svg')) {
            sprintf(
                '<figure %5$s><picture %11$s><img src="%1$s" role="%4$s" %2$s %6$s %7$s property="v:%3$s" content="%1$s" %8$s %9$s /></picture>%10$s</figure>',
                esc_url($source),
                $src_attributes,
                $properties,
                $role_atts,
                $fig_class ? 'class="wp-caption ' . $fig_class . '"' : '',
                $image_class ? 'class="' . $image_class . '"' : '',
                $image_id ? "id=\"$image_id\"" : '',
                implode(' ', $da_return),
                implode(' ', $aa_return),
                $caption,
                $pic_class ? "class=\"$pic_class\"" : '',
            );
        }
        return sprintf(
            '<figure %6$s><picture %12$s>%2$s<img src="%1$s" role="%5$s" %3$s  %7$s %8$s property="v:%4$s" content="%1$s" %9$s %10$s /></picture>%11$s</figure>',
            esc_url($source),
            ($webp_source ?? '') . $og_source,
            $src_attributes,
            $properties,
            $role_atts,
            $fig_class ? 'class="wp-caption ' . $fig_class . '"' : '',
            $image_class ? 'class="' . $image_class . '"' : '',
            $image_id ? "id=\"$image_id\"" : '',
            implode(' ', $da_return),
            implode(' ', $aa_return),
            $caption,
            $pic_class ? "class=\"$pic_class\"" : '',
        );
    }

    /**
     * Since this data is used in a few spots, I wanted to be able to just parse and return the data as is
     * as well as have the content all in the same spot
     *
     * @param int   $src_id
     * @param array $img_attrs
     *
     * @return array
     */
    public static function imgSrcSetArr(int $src_id, array $img_attrs = [])
    :array
    {

        // $img_attrs
        $img_size = $img_attrs['size'] ?? 'large';
        $img_prop = $img_attrs['property'] ?? 'image';

        // Image Information
        $img_src       = wp_get_attachment_image_url($src_id, $img_size);
        $src_set       = wp_get_attachment_image_srcset($src_id, $img_size) ?: '';
        $src_set_sizes = wp_get_attachment_image_sizes($src_id, $img_size) ?: '';
        $src_alt       = $img_attrs['alt'] ?? '';

        if (!$src_alt) {
            $src_alt = get_post_meta($src_id, '_wp_attachment_image_alt', true) ? get_post_meta($src_id, '_wp_attachment_image_alt', true) : get_the_title($src_id);
        }

        if (is_array($src_alt)) {
            $src_alt = $src_alt[0];
        }

        // Grabs the image extension
        if ($img_src) {
            $image_type = str_replace('.', '', substr($img_src, strrpos($img_src, '.')));

            return [
                'alt'           => html_entity_decode($src_alt),
                'img_type'      => "image/$image_type",
                'prop'          => $img_prop,
                'role'          => 'img',
                'src_set'       => $src_set,
                'src_set_sizes' => $src_set_sizes,
                'url'           => $img_src,
                'webp'          => self::getWebp($src_set) ?: self::searchWebP([$img_src]),
            ];
        }
        return [];
    }

    /**
     * Generates a proper formatted return of post images for Vue
     *
     * @param int    $post_thumbnail_id The image ID
     * @param string $image_size        The size of the image to return. Defaults to large
     *
     * @return array
     */
    public static function generateImgData(int $post_thumbnail_id, string $image_size = 'large')
    :array
    {
        if (!$post_thumbnail_id) {
            return [];
        }

        $post_meta_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
        $source        = wp_get_attachment_image_url($post_thumbnail_id, $image_size, false);

        $img_data = collect(
            [
                'alt'    => $post_meta_alt ? html_entity_decode($post_meta_alt) : html_entity_decode(get_the_title($post_thumbnail_id)),
                'src'    => wp_get_attachment_image_url($post_thumbnail_id, $image_size, false),
                'srcset' => wp_get_attachment_image_srcset($post_thumbnail_id, $image_size),
                'sizes'  => wp_get_attachment_image_sizes($post_thumbnail_id, $image_size) ?: '',
            ]
        );

        $img_data->put('type', 'image/' . str_replace('.', '', substr($source, strrpos($source, '.'))));

        // Handles the webp portion of the image
        $webp_srcset = self::getWebp($img_data->get('srcset'));
        if ($webp_srcset) {
            $img_data->put('webpSrcset', self::getWebp($img_data->get('srcset')));
        }

        return $img_data->toArray();
    }

    /**
     * Checks if there are any webp generated images in the uploads directory
     * and returns them as a concatenated string
     *
     * @param string $src_set The srcset that WP generates for the image
     *
     * @return string
     */
    protected static function getWebp(string $src_set)
    :string
    {
        // Creation of webp support
        return collect(explode(', ', $src_set))
            ->map(fn ($srcset) => self::searchWebP(explode(' ', $srcset) ?: $srcset))
            ->filter()
            ->implode(', ');
    }

    /**
     * Parse out the location of the webp file
     *
     * @param array $img_file
     *
     * @return string
     */
    protected static function searchWebP(array $img_file)
    :string
    {
        $home_url = get_home_url();
        if (!empty($img_file) && $img_file[0]) {
            $item_size = $img_file[1] ?? '';
            $extension = substr($img_file[0], strrpos($img_file[0], '.'));
            switch ($extension) {
                case '.jpg':
                case '.jpeg':
                case '.png':
                    $webp_file      = str_replace($extension, '.webp', $img_file[0]);
                    $webp_file_path = parse_url($webp_file)['path'];
                    $file_check     = WP_CONTENT_DIR . str_replace('/app', '', $webp_file_path);
                    if (file_exists($file_check)) {
                        $webp_image = "$home_url$webp_file_path $item_size";
                    }
                    break;
                default:
                    break;
            }
        }
        return $webp_image ?? '';
    }

    /**
     * Maps the data attributes
     *
     * @param array $data_atts
     *
     * @return array
     */
    protected static function mapDataAtts(array $data_atts)
    :array
    {
        return collect($data_atts)
            ->map(function ($att_val, $att_type) {
                return "data-$att_type=\"$att_val\"";
            })
            ->toArray();
    }

    /**
     * Maps the aria attributes
     *
     * @param array $aria_atts
     *
     * @return array
     */
    protected static function mapAriaAtts(array $aria_atts)
    :array
    {
        return collect($aria_atts)
            ->map(function ($att_val, $att_type) {
                return "$att_type=\"$att_val\"";
            })
            ->toArray();
    }
}
