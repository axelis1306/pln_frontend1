<!-- <div class="modal-data-submenu"> -->
<div class="form-group">
    <input type="text" class="form-control" id="title" name="title" placeholder="Sub menu title" value="<?= $submenu_row['title']; ?>">
</div>
<div class="form-group">
    <select name="id_user_menu" id="id_user_menu" class="form-control">
        <option value="">Select Menu </option>
        <?php foreach ($menu as $m) : ?>
            <option value="<?= $m['id_user_menu']; ?>" <?php if ($rowmenu == $m['menu']) {
                                                            echo 'selected';
                                                        } ?>><?= $m['menu']; ?> </option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <input type="text" class="form-control" id="url" name="url" placeholder="Sub menu url" value="<?= $submenu_row['url']; ?>">
</div>
<div class="form-group">
    <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub menu icon" value="<?= $submenu_row['icon']; ?>">
</div>
<input type="hidden" value="<?= $id; ?>" name="rowidsm">
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="is_active_submenu" value="1" name="is_active_submenu" <?= check_access_active($submenu_row['id_user_sub_menu']); ?>>
        <label class="form-check-label" for="is_active_submenu">
            Active?
        </label>
    </div>
</div>
<div class="form-group">
    <input type="hidden" class="form-control" id="form_type" name="form_type" value="edit-submenu">
</div>
<!-- </div> -->