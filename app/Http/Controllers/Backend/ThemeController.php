<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\SiteHelpers;
use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ThemeController extends Controller
{
    public function index()
    {
        Gate::authorize('app.theme.index');
        return view('backend.themes.index');
    }

    public function update_mode_light(Theme $theme)
    {
        if (SiteHelpers::themes()->mode == 'light') {
            $theme->update([
                'mode' => 'dark'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'mode' => 'light'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_mode_dark(Theme $theme)
    {
        if (SiteHelpers::themes()->mode == 'dark') {
            $theme->update([
                'mode' => 'light'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'mode' => 'dark'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_width_fluid(Theme $theme)
    {
        if (SiteHelpers::themes()->width == 'fluid') {
            $theme->update([
                'width' => 'boxed'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'width' => 'fluid'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_width_boxed(Theme $theme)
    {
        if (SiteHelpers::themes()->width == 'boxed') {
            $theme->update([
                'width' => 'fluid'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'width' => 'boxed'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_menu_position_fixed(Theme $theme)
    {
        if (SiteHelpers::themes()->menu_position == 'fixed') {
            $theme->update([
                'menu_position' => 'scrollable'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'menu_position' => 'fixed'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_menu_position_scrollable(Theme $theme)
    {
        if (SiteHelpers::themes()->menu_position == 'scrollable') {
            $theme->update([
                'menu_position' => 'fixed'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'menu_position' => 'scrollable'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_sidebarcolor_light(Theme $theme)
    {
        if (SiteHelpers::themes()->sidebar_color == 'light') {
            $theme->update([
                'sidebar_color' => 'dark'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'sidebar_color' => 'light'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_sidebarcolor_dark(Theme $theme)
    {
        if (SiteHelpers::themes()->sidebar_color == 'dark') {
            $theme->update([
                'sidebar_color' => 'light'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'sidebar_color' => 'dark'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_sidebarcolor_brand(Theme $theme)
    {
        if (SiteHelpers::themes()->sidebar_color == 'brand') {
            $theme->update([
                'sidebar_color' => 'gradient'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'sidebar_color' => 'brand'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_sidebarcolor_gradient(Theme $theme)
    {
        if (SiteHelpers::themes()->sidebar_color == 'gradient') {
            $theme->update([
                'sidebar_color' => 'brand'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'sidebar_color' => 'gradient'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_sidebar_size(Request $request, Theme $theme)
    {
        if ($request->ajax()) {
            $theme->update([
                'sidebar_size' => $request->sidebar_size
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_sidebar_showuser(Request $request, Theme $theme)
    {
        if ($request->sidebar_showuser == 'true') {
            $theme->update([
                'sidebar_showuser' => 'false'
            ]);
            return response()->json(['success' => 'Update successfully']);
        } else {
            $theme->update([
                'sidebar_showuser' => 'true'
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }

    public function update_topbar_color(Request $request, Theme $theme)
    {
        if ($request->ajax()) {
            $theme->update([
                'topbar_color' => $request->topbar_color
            ]);
            return response()->json(['success' => 'Update successfully']);
        }
        return response()->json(['error' => 'Not found']);
    }
}
