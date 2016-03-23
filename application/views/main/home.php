<div id="error-message" class="error hidden"><h2>The following errors occured:</h2> <ul id="error-list"></ul></div>
<div class="block full-block">
    <?php
    $data = array(
        'name' => 'quest_check',
        'id' => 'quest_check',
        'onsubmit' => "return checkQuest(this, this.id);"
    );
    echo form_open('', $data);
    ?>

    <input type="hidden" name="api_error" id="api_error" value="false" />

    <ul id="questions">
        <li>
            <label for="realm">Select Server</label>

            <select name="realm" id="realm" onchange="refreshSelect(this);">
                <option value="0">------</option>
                <?php foreach ($realms as $r) : ?>
                    <option value="<?= $r->slug; ?>"><?= $r->name; ?></option>
                <?php endforeach; ?>
            </select>
        </li>
        <li id="entries" style="display: block;">
            <label for="alias">Alias</label>
            <input type="text" name="alias" id="alias" />

            <label for="quest_id">Quest ID (question mark image here)</label>
            <input type="text" name="quest_id" id="quest_id" />

            <?php
            $data = array(
                'name' => 'quest_check_submit',
                'id' => 'quest_check_submit',
                'class' => 'blue-button',
                'value' => 'Check Quest'
            );
            ?>
            <?php echo form_submit($data); ?>
        </li>
    </ul>

    <div id="response" style="display: none;"></div>
</div>