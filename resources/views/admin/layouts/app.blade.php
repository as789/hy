<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @section('css')
    <link rel="stylesheet" href="/static/admin/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/css/public.css" media="all">
    @show
</head>
<body>
<div class="layuimini-container">
      @yield('content')
</div>
 @section('js')
<script src="/static/admin/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
<script src="/static/admin/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>

<script>
let route = (routeUrl, param) => {
    let append = [];

    for (let x in param) {
        let search = '{' + x + '}';

        if (routeUrl.indexOf(search) >= 0) {
            routeUrl = routeUrl.replace('{' + x + '}', param[x]);
        } else {
            append.push(x + '=' + param[x]);
        }
    }

    let url = '/' + routeUrl.trim('/');

    if (append.length == 0) {
        return url;
    }

    if (url.indexOf('?') >= 0) {
        url += '&';
    } else {
        url += '?';
    }

    url += append.join('&');

    return url;
}
</script>

@show
</body>
</html>
