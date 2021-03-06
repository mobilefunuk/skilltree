<?= $this->Nav->display(['actions' => ['edit', 'delete'], 'id' => $rank->id]); ?>

<div class="ranks view large-9 medium-8 columns content">
    <h3><?= h($rank->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= h($rank->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Skill') ?></th>
            <td><?= $rank->has('skill') ? $this->Html->link($rank->skill->title, ['controller' => 'Skills', 'action' => 'view', $rank->skill->id]) : '' ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($rank->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users Skills') ?></h4>
        <?php if (!empty($rank->users_skills)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('User Id') ?></th>
                <th><?= __('Skill Id') ?></th>
                <th><?= __('Rank Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rank->users_skills as $usersSkills): ?>
            <tr>
                <td><?= h($usersSkills->user_id) ?></td>
                <td><?= h($usersSkills->skill_id) ?></td>
                <td><?= h($usersSkills->rank_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UsersSkills', 'action' => 'view', $usersSkills->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UsersSkills', 'action' => 'edit', $usersSkills->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UsersSkills', 'action' => 'delete', $usersSkills->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersSkills->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
