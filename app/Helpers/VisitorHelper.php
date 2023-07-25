<?php

use App\Models\Visitor;

if (!function_exists('visits')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function visit_list($ip)
    {
        $visitor = Visitor::where('ip', $ip)->first();
        return $visitor;
    }

    function visit_new($ip)
    {
        $visitor = Visitor::where('ip', $ip)->first();
        if (isset($visitor->ip) != null) {
            $visitor->update([
                'device' => visitor()->device(),
                'platform' => visitor()->platform(),
                'browser' => visitor()->browser(),
                'ip' => $ip,
                'useragent' => visitor()->useragent(),
                'hits' => $visitor->hits + 1,
            ]);
            return $visitor;
        }
        $visitor_new = Visitor::create([
            'device' => visitor()->device(),
            'platform' => visitor()->platform(),
            'browser' => visitor()->browser(),
            'ip' => visitor()->ip(),
            'useragent' => visitor()->useragent(),
        ]);
        return $visitor_new;
    }

    function visit_update($id)
    {
        $visitor = Visitor::where('id', $id)->first();
        $visitor->update([
            'device' => visitor()->device(),
            'platform' => visitor()->platform(),
            'browser' => visitor()->browser(),
            'ip' => $visitor->ip,
            'useragent' => visitor()->useragent(),
            'hits' => $visitor->hits + 1,
        ]);
        return $visitor;
    }

    function visits()
    {
        $visitor = Visitor::sum('hits');
        return $visitor;
    }

    function setIp($key, $default = null)
    {
        return Visitor::getIp($key, $default);
    }
}
