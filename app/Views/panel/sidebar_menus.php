<?php foreach ($menus as $menu) { ?>
    <?php if ($menu['menu_parent'] === "0" && $menu['menu_link'] === "#") { ?>
        <li class=" navigation-header">
            <span><?= esc($menu['menu_name']) ?></span>
        </li>
    <?php } else { ?>
        <li class="<?= url_is("{$menu['menu_link']}*") ? 'active' : '' ?> nav-item">
            <a class="d-flex align-items-center" href="<?= base_url($menu['menu_link']) ?>">
                <?= esc($menu['menu_icon'], 'raw', true) ?>
                <span class="menu-title text-truncate"><?= esc($menu['menu_name']) ?></span></a>
        </li>
    <?php } ?>
    <?php foreach ($menu['childs'] as $child) { ?>
        <li class="<?= url_is("{$child['menu_link']}*") ? 'active' : '' ?> nav-item">
            <a class="d-flex align-items-center" href="<?= base_url($child['menu_link']) ?>">
                <?= esc($child['menu_icon'], 'raw', true) ?>
                <span class="menu-title text-truncate"><?= esc($child['menu_name']) ?></span></a>
        </li>
    <?php } ?>
<?php } ?>