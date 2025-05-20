<?php
if (!function_exists('seoUrl')) {
    function seoUrl($string = null)
    {
        if (strlen($string) > 0) {
            // Remove HTML Tags if found
            $string = strip_tags($string);
            // Replace special characters with white space
            $string = preg_replace('/[^A-Za-z0-9-]+/', ' ', $string);
            // Trim White Spaces and both sides
            $string = trim($string);
            // Replace whitespaces with Hyphen (-)
            $string = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
            // Conver final string to lowercase
            $slug = strtolower($string);
            return $slug;
        }
    }
}
if (!function_exists('set_unique_image_file_name_on_save')) {
    function set_unique_image_file_name_on_save($unique_param = '', $extension = '')
    {
        $unique_param .= '-----';
        return base64_encode($unique_param) . '.' . $extension;
    }
}
