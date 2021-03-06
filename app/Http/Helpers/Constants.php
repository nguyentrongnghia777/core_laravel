<?php

namespace App\Http\Helpers;

Class Constants {
	// table
	const USERS = 'users';
	const USERS_GROUPS = 'users_groups';
	const GROUPS = 'groups';
	const BLOGS = 'blogs';
	const CATEGORIES = 'categories';
	const PRODUCTS = 'products';
    const DEVICES = 'devices';

	// user role
    const ROLES_ADMIN = 'admin';
    const ROLES_MEMBER = 'member';

    // type_device
    const ANDROID = 'android';
    const IOS = 'ios';
    const WINDOWS_PHONE = 'windows_phone';
    const UNKNOW = 'unknow';

    // paging page admin
    const ADMIN_DEFAULT_PAGING = 5;

    // url blog image
    const URL_IMAGE_BLOG = '/uploads/blog/';

    // url product image
    const URL_IMAGE_PRODUCT = '/uploads/product/';
}