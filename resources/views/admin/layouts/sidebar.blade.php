<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            {{ App\Helper\MenuCreator::menuLister(App\Helper\Standarts::$adminModules) }}
        </ul>
    </div>
</div>
<!-- / main menu-->