<?php
namespace App\Enums;

enum ImageSizeEnum: int
{
    case GALLERY_EVENT_NOTICE_MEDIUM_IMAGE_WIDTH = 340;
    case GALLERY_EVENT_NOTICE_MEDIUM_IMAGE_HEIGHT = 200; // simple keep this negative because our enum got integer value. so that if any positive value present then it would be the original height
    case BANNER_MEDIUM_IMAGE_WIDTH = 1750;
    case OTHERS_MEDIUM_IMAGE_WIDTH = 1024;
    case OTHERS_MEDIUM_IMAGE_HEIGHT = 768;
    case NEWS_MEDIUM_IMAGE_WIDTH = 390;
    case NEWS_MEDIUM_IMAGE_HEIGHT = 154;
    case ADDS_MEDIUM_IMAGE_WIDTH = 376;
    case ADDS_BANNER_MEDIUM_IMAGE_HEIGHT = 470;
    case COUNCIL_MEDIUM_IMAGE_SIZE = 160;
    case ADDS_MEDIUM_IMAGE_HEIGHT =330;
}

