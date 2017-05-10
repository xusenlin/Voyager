@if(config('voyager.show_dev_tips'))
    <div class="container-fluid">
        <div class="alert alert-info">
            <strong>如何使用:</strong>
            <p>你可以调用 <code>menu('{{ !empty($menu) ? $menu->name : 'name' }}')</code>在站点的任何位置输出菜单</p>
        </div>
    </div>
@endif
