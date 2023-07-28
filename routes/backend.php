<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CoordinateController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EducationController;
use App\Http\Controllers\Backend\GaleryController;
use App\Http\Controllers\Backend\GeneralSettingController;
use App\Http\Controllers\Backend\ItemMenuController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\MailSettingController;
use App\Http\Controllers\Backend\MapController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PostVideoController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RegionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SeoSettingController;
use App\Http\Controllers\Backend\SiteMapController;
use App\Http\Controllers\Backend\SocialLoginController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubMenuController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\TapController;
use App\Http\Controllers\Backend\ThemeController;
use App\Http\Controllers\Backend\VisibilityController;
use App\Http\Controllers\Backend\WidgetController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VillageController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// posts
Route::get('/post-list', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/load-data', [PostController::class, 'load_data'])->name('posts.load-data');
Route::get('/post/load-sub-category', [PostController::class, 'sub_category'])->name('posts.sub-category');
Route::get('/post/article-create', [PostController::class, 'create'])->name('posts.create');
Route::post('/post/article-store', [PostController::class, 'store'])->name('posts.store');
Route::get('/post/{post}/article-edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/post/{post}/article-update', [PostController::class, 'update'])->name('posts.update');
Route::delete('/post/article-delete', [PostController::class, 'delete'])->name('posts.delete');

Route::get('/post/video-create', [PostVideoController::class, 'create'])->name('posts.create-video');
Route::post('/post/video-store', [PostVideoController::class, 'store'])->name('posts.store-video');
Route::get('/post/{post}/video-edit', [PostVideoController::class, 'edit'])->name('posts.edit-video');
Route::put('/post/{post}/video-update', [PostVideoController::class, 'update'])->name('posts.update-video');

Route::post('/post/tmpupload-img', [PostController::class, 'tmpupload_img'])->name('posts.tmp-upload-img');
Route::delete('/post/tmpupload-img', [PostController::class, 'tmpdelete_img'])->name('posts.tmp-delete-img');

Route::post('/post/tmp-upload-thumb', [PostVideoController::class, 'tmpupload_thumb'])->name('posts.tmpupload-video-thumb');
Route::post('/post/tmp-upload', [PostVideoController::class, 'tmpupload_img'])->name('posts.tmpupload-video-img');
Route::delete('/post/tmp-upload', [PostVideoController::class, 'tmpdelete_img'])->name('posts.tmpdelete-video');

// tag
Route::post('/tag/create', [TagController::class, 'create'])->name('tags.create');

// categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/load-data', [CategoryController::class, 'load_data'])->name('categories.load-data');
Route::post('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/categories/{categorie}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{categorie}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/delete', [CategoryController::class, 'delete'])->name('categories.destroy');

// sub categories
Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('subcategories.index');
Route::get('/sub-categories/load-data', [SubCategoryController::class, 'load_data'])->name('subcategories.load-data');
Route::post('/sub-categories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
Route::get('/sub-categories/{subCategorie}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
Route::put('/sub-categories/{subCategorie}/update', [SubCategoryController::class, 'update'])->name('subcategories.update');
Route::delete('/sub-categories/delete', [SubCategoryController::class, 'delete'])->name('subcategories.destroy');

// visibility
Route::get('/visibility', [VisibilityController::class, 'index'])->name('visibilities.index');
Route::get('/visibility/load-data', [VisibilityController::class, 'load_data'])->name('visibilities.load-data');
Route::post('/visibility/create', [VisibilityController::class, 'create'])->name('visibilities.create');
Route::post('/visibility/edit', [VisibilityController::class, 'edit'])->name('visibilities.edit');
Route::delete('/visibility/delete', [VisibilityController::class, 'delete'])->name('visibilities.destroy');

// Galery
Route::get('/galery', [GaleryController::class, 'index'])->name('galeries.index');
Route::get('/galery/load-data', [GaleryController::class, 'load_data'])->name('galeries.load-data');
Route::get('/galery/create', [GaleryController::class, 'create'])->name('galeries.create');
Route::post('/galery/store', [GaleryController::class, 'store'])->name('galeries.store');
Route::get('/galery/{galerie}/edit', [GaleryController::class, 'edit'])->name('galeries.edit');
Route::put('/galery/{galerie}/update', [GaleryController::class, 'update'])->name('galeries.update');
Route::delete('/galery/delete', [GaleryController::class, 'delete'])->name('galeries.destroy');
Route::post('/galery/tmp-upload', [GaleryController::class, 'tmpupload_img'])->name('galeries.tmp-upload-image');
Route::delete('/galery/tmp-delete', [GaleryController::class, 'tmpdelete_img'])->name('galeries.tmp-delete');

Route::get('/tabs', [TapController::class, 'index'])->name('tabs.index');
Route::get('/tabs/load-data', [TapController::class, 'load_data'])->name('tabs.load-data');
Route::post('/tabs/create', [TapController::class, 'create'])->name('tabs.create');
Route::get('/tabs/show-edit', [TapController::class, 'show_edit'])->name('tabs.show-edit');
Route::post('/tabs/edit', [TapController::class, 'edit'])->name('tabs.edit');
Route::delete('/tabs/delete', [TapController::class, 'delete'])->name('tabs.delete');

// Widget
Route::get('/widget', [WidgetController::class, 'index'])->name('widgets.index');
Route::get('/widget/load-data', [WidgetController::class, 'load_data'])->name('widgets.load-data');
Route::get('/widget/create', [WidgetController::class, 'create'])->name('widgets.create');
Route::post('/widget/store', [WidgetController::class, 'store'])->name('widgets.store');
Route::get('/widget/{widget}/edit', [WidgetController::class, 'edit'])->name('widgets.edit');
Route::put('/widget/{widget}/update', [WidgetController::class, 'update'])->name('widgets.update');
Route::delete('/widget/delete', [WidgetController::class, 'delete'])->name('widgets.delete');

// Maps
Route::get('/map-list', [MapController::class, 'index'])->name('maps.index');
Route::get('/map-list/load-data', [MapController::class, 'load_data'])->name('maps.load-data');
Route::get('/map-list/create', [MapController::class, 'create'])->name('maps.create');
Route::post('/map-list/store', [MapController::class, 'store'])->name('maps.store');
Route::get('/map-list/{map}/edit', [MapController::class, 'edit'])->name('maps.edit');
Route::put('/map-list/{map}/update', [MapController::class, 'update'])->name('maps.update');
Route::get('/map-list/{region}/village', [MapController::class, 'village'])->name('maps.village');
Route::delete('/map-list/delete', [MapController::class, 'delete'])->name('maps.delete');

// Region
Route::get('/map/region', [RegionController::class, 'index'])->name('regions.index');
Route::get('/region/load-data', [RegionController::class, 'load_data'])->name('regions.load-data');
Route::post('/region/create', [RegionController::class, 'create'])->name('regions.create');
Route::get('/region/show', [RegionController::class, 'show'])->name('regions.show');
Route::post('/region/edit', [RegionController::class, 'edit'])->name('regions.edit');
Route::delete('/region/delete', [RegionController::class, 'delete'])->name('regions.delete');

// Village
Route::get('/village', [VillageController::class, 'index'])->name('villages.index');
Route::get('/village/load-data', [VillageController::class, 'load_data'])->name('villages.load-data');
Route::post('/village/create', [VillageController::class, 'create'])->name('villages.create');
Route::get('/village/{village}/edit', [VillageController::class, 'edit'])->name('villages.edit');
Route::post('/village/update', [VillageController::class, 'update'])->name('villages.update');
Route::delete('/village/delete', [VillageController::class, 'delete'])->name('villages.delete');

// Education
Route::get('/education', [EducationController::class, 'index'])->name('educations.index');
Route::get('/education/load-data', [EducationController::class, 'load_data'])->name('educations.load-data');
Route::post('/education/create', [EducationController::class, 'create'])->name('educations.create');
Route::get('/education/show', [EducationController::class, 'show'])->name('educations.show');
Route::post('/education/edit', [EducationController::class, 'edit'])->name('educations.edit');
Route::delete('/education/delete', [EducationController::class, 'delete'])->name('educations.delete');

// Coordinate
Route::get('/coordinate', [CoordinateController::class, 'index'])->name('coordinates.index');
Route::get('/coordinate/load-data', [CoordinateController::class, 'load_data'])->name('coordinates.load-data');
Route::get('/coordinate/load-file', [CoordinateController::class, 'load_file'])->name('coordinates.load-file');
Route::get('/coordinate/create', [CoordinateController::class, 'create'])->name('coordinates.create');
Route::post('/coordinate/store', [CoordinateController::class, 'store'])->name('coordinates.store');
Route::post('/coordinate/store-file', [CoordinateController::class, 'store_file'])->name('coordinates.store-file');
Route::get('/coordinate/{coordinate}/edit', [CoordinateController::class, 'edit'])->name('coordinates.edit');
Route::get('/coordinate/{coordinate}/edit/type', [CoordinateController::class, 'edit_file'])->name('coordinates.edit-type');
Route::put('/coordinate/{coordinate}/update', [CoordinateController::class, 'update'])->name('coordinates.update');
Route::put('/coordinate/{coordinate}/update-file', [CoordinateController::class, 'update_file'])->name('coordinates.update-file');
Route::delete('/coordinate/delete', [CoordinateController::class, 'delete'])->name('coordinates.delete');
Route::post('/coordinate/tmp-upload', [CoordinateController::class, 'tmpupload_img'])->name('coordinates.tmpupload-img');
Route::delete('/coordinate/tmp-upload', [CoordinateController::class, 'tmpdelete_img'])->name('coordinates.tmpdelete');

// modules
Route::get('/module', [ModuleController::class, 'index'])->name('modules.index');
Route::get('/module/load-data', [ModuleController::class, 'load_data'])->name('modules.load-data');
Route::post('/module/module-create', [ModuleController::class, 'create'])->name('modules.create');
Route::post('/module/module-editable', [ModuleController::class, 'module_editable'])->name('modules.editable');
Route::delete('/module/module-delete', [ModuleController::class, 'hapus'])->name('modules.destroy');

// permission
Route::get('/permission', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('/permission/load-data', [PermissionController::class, 'load_data'])->name('permissions.load-data');
Route::post('/permission/permission-create', [PermissionController::class, 'create'])->name('permissions.create');
Route::put('/permission/{permission}/permission-update', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('/permission/permission-delete', [PermissionController::class, 'hapus'])->name('permissions.destroy');

// role
Route::get('/role', [RoleController::class, 'index'])->name('roles.index');
Route::get('/role/{role}/sitemap', [RoleController::class, 'sitemap'])->name('roles.sitemap');
Route::get('/role/load-data', [RoleController::class, 'load_data'])->name('roles.load-data');
Route::get('/role/create-role', [RoleController::class, 'create'])->name('roles.create');
Route::post('/role/post-role', [RoleController::class, 'post'])->name('roles.post');
Route::get('/role/{role}/edit-role', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/role/{role}/update-role', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/role/hapus-data', [RoleController::class, 'hapus'])->name('roles.destroy');
Route::delete('/role/hapus-permission', [RoleController::class, 'hapus_rolePermission'])->name('roles.destroy-permission');

Route::get('/role/submenu', [RoleController::class, 'load_submenu'])->name('roles.submenu');
Route::get('/role/menuitem', [RoleController::class, 'load_menuitem'])->name('roles.menuitem');
Route::post('/role/{role}/create-access', [RoleController::class, 'update_menu_access'])->name('roles.create-access-menu');

// profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.update');
Route::put('/profile/{user}/password', [ProfileController::class, 'edit_password'])->name('profile.password');
Route::put('/profile/{user}/upload-img', [ProfileController::class, 'upload_foto'])->name('profile.upload-img');
Route::post('/profile/tmpupload-img', [ProfileController::class, 'tmpupload_img'])->name('profile.tmpupload-img');
Route::delete('/profile/tmpdelete-img', [ProfileController::class, 'tmpdelete_img'])->name('profile.tmpdelete-img');

// user
Route::get('/user', [UserController::class, 'index'])->name('users.index');
Route::get('/user/load-data', [UserController::class, 'load_data'])->name('users.load-data');
Route::get('/user/user-create', [UserController::class, 'create'])->name('users.create');
Route::post('/user/user-post', [UserController::class, 'post'])->name('users.post');
Route::get('/user/{user}/user-edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/user/{user}/user-update', [UserController::class, 'update'])->name('users.update');
Route::post('/user/user-edittable', [UserController::class, 'update_data'])->name('users.edittable');
Route::delete('/user/{user}/user-delete', [UserController::class, 'hapus'])->name('users.destroy');

// seo setting
Route::get('/seo-setting', [SeoSettingController::class, 'index'])->name('seo-setting.index');
Route::post('/seo-setting/edit', [SeoSettingController::class, 'edit'])->name('seo-setting.edit');
Route::put('/seo-setting/{generalSetting}/update', [SeoSettingController::class, 'update'])->name('seo-setting.update');
Route::put('/seo-setting/{generalSetting}/upload', [SeoSettingController::class, 'upload_og_img'])->name('seo-setting.upload');
Route::post('/seo-setting/tmpog_img', [SeoSettingController::class, 'tmpog_img'])->name('seo-setting.tmpog_img');
Route::delete('/seo-setting/tmpdelete_ogimg', [SeoSettingController::class, 'tmpdelete_ogimg'])->name('seo-setting.tmpdelete_ogimg');

// mail setting
Route::get('/mail-setting', [MailSettingController::class, 'index'])->name('mails.index');
Route::put('/mail-setting/{mailSetting}/update', [MailSettingController::class, 'update'])->name('mails.update');

// themes
Route::get('/theme', [ThemeController::class, 'index'])->name('theme.index');

Route::post('/theme/{theme}/update-mode-light', [ThemeController::class, 'update_mode_light'])->name('theme.update-mode-light');
Route::post('/theme/{theme}/update-mode-dark', [ThemeController::class, 'update_mode_dark'])->name('theme.update-mode-dark');

Route::post('/theme/{theme}/update-width-fluid', [ThemeController::class, 'update_width_fluid'])->name('theme.update-width-fluid');
Route::post('/theme/{theme}/update-width-boxed', [ThemeController::class, 'update_width_boxed'])->name('theme.update-width-boxed');

Route::post('/theme/{theme}/update-menu-position-fixed', [ThemeController::class, 'update_menu_position_fixed'])->name('theme.update-menu-position-fixed');
Route::post('/theme/{theme}/update-menu-position-scrollable', [ThemeController::class, 'update_menu_position_scrollable'])->name('theme.update-menu-position-scrollable');

Route::post('/theme/{theme}/update-sidebarcolor-light', [ThemeController::class, 'update_sidebarcolor_light'])->name('theme.update-sidebarcolor-light');
Route::post('/theme/{theme}/update-sidebarcolor-dark', [ThemeController::class, 'update_sidebarcolor_dark'])->name('theme.update-sidebarcolor-dark');
Route::post('/theme/{theme}/update-sidebarcolor-brand', [ThemeController::class, 'update_sidebarcolor_brand'])->name('theme.update-sidebarcolor-brand');
Route::post('/theme/{theme}/update-sidebarcolor-gradient', [ThemeController::class, 'update_sidebarcolor_gradient'])->name('theme.update-sidebarcolor-gradient');
Route::post('/theme/{theme}/update-sidebar-showuser', [ThemeController::class, 'update_sidebar_showuser'])->name('theme.update-sidebar-showuser');
Route::post('/theme/{theme}/update-sidebar-size', [ThemeController::class, 'update_sidebar_size'])->name('theme.update-sidebar-size');
Route::post('/theme/{theme}/update-topbar-color', [ThemeController::class, 'update_topbar_color'])->name('theme.update-topbar-color');

// menus
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/menus/load-data', [MenuController::class, 'load_data'])->name('menus.load-data');
Route::post('/menus/create-menu', [MenuController::class, 'create'])->name('menus.create');
Route::get('/menus/show-menu', [MenuController::class, 'show'])->name('menus.show');
Route::post('/menus/edit-menu', [MenuController::class, 'edit'])->name('menus.edit');
Route::post('/menus/deletable-menu', [MenuController::class, 'update_deletable'])->name('menus.update-deletable');
Route::delete('/menus/delete-menu', [MenuController::class, 'delete'])->name('menus.destroy');

// submenu 
Route::post('/sub-menus/create-submenu', [SubMenuController::class, 'create'])->name('submenus.create');
Route::put('/sub-menus/{subMenu}/edit-submenu', [SubMenuController::class, 'edit'])->name('submenus.edit');
Route::delete('/sub-menus/delete-submenu', [SubMenuController::class, 'delete'])->name('submenus.delete');

// Item menu
Route::post('/item-menus/create-itemmenu', [ItemMenuController::class, 'create'])->name('itemmenu.create');
Route::put('/item-menus/{menuItem}/edit-itemmenu', [ItemMenuController::class, 'edit'])->name('itemmenu.edit');
Route::delete('/item-menus/delete-itemmenu', [ItemMenuController::class, 'delete'])->name('itemmenu.delete');

// sitemap
Route::get('/sitemap', [SiteMapController::class, 'index'])->name('sitemaps.index');

// General Setting
Route::get('/setting', [GeneralSettingController::class, 'index'])->name('settings.index');
Route::get('/setting/company-setting', [GeneralSettingController::class, 'company_setting'])->name('settings.company-setting');
Route::get('/setting/social-setting', [GeneralSettingController::class, 'social_setting'])->name('settings.social-setting');

Route::get('/setting/social-login-setting', [SocialLoginController::class, 'index'])->name('settings.social-login-setting');
Route::put('/setting/{socialLogin}/update-social-login', [SocialLoginController::class, 'update'])->name('settings.update-social-login');

Route::get('/setting/recaptcha-setting', [GeneralSettingController::class, 'recaptcha_setting'])->name('settings.recaptcha-setting');
Route::put('setting/{generalSetting}/update-recaptcha', [GeneralSettingController::class, 'update_status_recaptcha'])->name('settings.recaptcha-update');

// language
Route::get('/setting/language-setting', [LanguageController::class, 'index'])->name('languages.index');
Route::post('/setting/language-setting/store', [LanguageController::class, 'store'])->name('languages.store');
Route::post('/setting/language-setting/transUpdate', [LanguageController::class, 'transUpdate'])->name('languages.transUpdate');
Route::post('/setting/language-setting/transUpdateKey', [LanguageController::class, 'transUpdateKey'])->name('languages.transUpdateKey');
Route::post('/setting/language-setting/create-language', [LanguageController::class, 'createLanguage'])->name('languages.createLanguage');
Route::delete('/setting/language-setting/{key}/destroy', [LanguageController::class, 'destroy'])->name('languages.destroy');

// Country
Route::get('/setting/country/load-data', [CountryController::class, 'load_data'])->name('countries.load-data');
Route::get('/setting/country/create', [CountryController::class, 'create'])->name('countries.create');
Route::post('/setting/country/store', [CountryController::class, 'store'])->name('countries.store');
Route::get('/setting/country/{language}/edit', [CountryController::class, 'edit'])->name('countries.edit');
Route::put('/setting/country/{language}/update', [CountryController::class, 'update'])->name('countries.update');
Route::delete('/setting/country/delete', [CountryController::class, 'delete'])->name('countries.delete');

Route::post('/setting/update', [GeneralSettingController::class, 'edit'])->name('settings.update');
Route::put('/setting/{generalSetting}/upload-user', [GeneralSettingController::class, 'upload_img_user'])->name('settings.upload-user');
Route::put('/setting/{generalSetting}/upload-fav', [GeneralSettingController::class, 'upload_img_fav'])->name('settings.upload-fav');
Route::put('/setting/{generalSetting}/upload-sm', [GeneralSettingController::class, 'upload_img_sm'])->name('settings.upload-sm');
Route::put('/setting/{generalSetting}/upload-lg', [GeneralSettingController::class, 'upload_img_lg'])->name('settings.upload-lg');
Route::put('/setting/{generalSetting}/upload-nota', [GeneralSettingController::class, 'upload_img_nota'])->name('settings.upload-nota');
Route::post('/setting/tmp-img-user', [GeneralSettingController::class, 'tmpimg_user'])->name('settings.tmp-img-user');
Route::delete('/setting/tmp-delete-user', [GeneralSettingController::class, 'tmpdelete_imguser'])->name('settings.tmp-delete-user');
Route::post('/setting/tmp-img-fav', [GeneralSettingController::class, 'tmpimg_fav'])->name('settings.tmp-img-fav');
Route::delete('/setting/tmp-delete-fav', [GeneralSettingController::class, 'tmpdelete_imgfav'])->name('settings.tmp-delete-fav');
Route::post('/setting/tmp-img-sm', [GeneralSettingController::class, 'tmpimg_sm'])->name('settings.tmp-img-sm');
Route::delete('/setting/tmp-delete-sm', [GeneralSettingController::class, 'tmpdelete_imgsm'])->name('settings.tmp-delete-sm');
Route::post('/setting/tmp-img-lg', [GeneralSettingController::class, 'tmpimg_lg'])->name('settings.tmp-img-lg');
Route::delete('/setting/tmp-delete-lg', [GeneralSettingController::class, 'tmpdelete_imglg'])->name('settings.tmp-delete-lg');
Route::post('/setting/tmp-img-nota', [GeneralSettingController::class, 'tmpimg_nota'])->name('settings.tmp-img-nota');
Route::delete('/setting/tmp-delete-nota', [GeneralSettingController::class, 'tmpdelete_imgnota'])->name('settings.tmp-delete-nota');
