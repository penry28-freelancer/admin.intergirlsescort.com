<?php

/**
 * @param string $content
 * @param string $start
 * @param string $end
 * @return string
 */
function get_between_content($content, $start, $end)
{
    $r = explode($start, $content);
    if (isset($r[1])) {
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}

/**
 * @param \Exception $e
 * @return void
 */
function write_log_exception(\Exception $e = null)
{
    \Log::error('➤Message ex::' . $e->getMessage() . PHP_EOL . '#0 More exception::' . get_between_content($e->getTraceAsString(), '#0', '#10') . PHP_EOL . PHP_EOL);
}

/**
 * Get email address by shop or by admin
 * @param model $shop
 * @return string
 */
function get_sender_email($shop = null)
{
    if ($shop) {
        return 'shop-test@gmail.com';
    }
    return 'admin-test@gmail.com';
}

function get_sender_name($shop = null)
{
    if ($shop) {
        return 'shop-email-name';
    }
    return 'admin-email-name';
}

function get_storage_image_url($path, $size = 'default')
{
    if (empty($path)) {
        return get_placeholder_image($size);
    }

    if (empty($size)) {
        return url($path);
    }

    $size  = config('image.sizes.' . $size);

    return url("{$path}?width={$size['w']}&height={$size['h']}&fit={$size['fit']}");
}

function get_storage_file_url($path = null, $size = 'small')
{
    if (! $path) {
        return get_placeholder_img($size);
    }

    if($size == Null) {
        return url("storage/{$path}");
    }

    return url("storage/{$path}?p={$size}");
}

function get_placeholder_img($size = 'small')
    {
        $size = config("image.sizes.{$size}");

        if ($size && is_array($size)) {
            return "https://via.placeholder.com/{$size['w']}x{$size['h']}/";
        }

        return url("images/placeholders/no_img.png");
    }

function get_placeholder_image($size)
{
    $size = config("image.sizes.{$size}");

    if ($size && is_array($size)) {
        return "https://via.placeholder.com/{$size['w']}x{$size['h']}/eee?fit={$size['fit']}&text=" . trans('app.no_img_available');
    }

    return url("images/placeholders/no_img.png");
}

function get_file_version($file)
{
    return "{$file}?v=" . date('YmdHis', filemtime(public_path($file)));
}

function svg_icon($filename, $w = 21, $h = 21)
{
    $filepath = '/assets/img/svg/'. $filename .'.svg';

    if (file_exists(public_path($filepath))) {
        $sw = $w ? 'width=' . $w . 'px' : '';
        $sh = $h ? 'height=' . $h . 'px' : '';
        return '<img '. $sw .' '. $sh .' src="'. $filepath .'" alt="' . $filename . '" />';
    }

    return '';
}

function format_date($date, $format = 'd-m-Y')
{
    return date($format, strtotime($date));
}


function image_storage_dir()
{
    return config('image.dir.default');
}

/*
 * Convert kilogram to lbs
 * @param $kg
 */
function kg_to_lbs($kg)
{
    return $kg * 2.2;
}
