<?= $this->Nav->display(['actions' => ['edit', 'delete'], 'id' => $skillsTree->id]); ?>

<div class="skillsTree view large-9 medium-8 columns content">
    <h3><?= h($skillsTree->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= h($skillsTree->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Parent Skills Tree') ?></th>
            <td><?= $skillsTree->has('parent_skills_tree') ? $this->Html->link($skillsTree->parent_skills_tree->id, ['controller' => 'SkillsTree', 'action' => 'view', $skillsTree->parent_skills_tree->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Skill') ?></th>
            <td><?= $skillsTree->has('skill') ? $this->Html->link($skillsTree->skill->title, ['controller' => 'Skills', 'action' => 'view', $skillsTree->skill->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($skillsTree->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Lft') ?></th>
            <td><?= $this->Number->format($skillsTree->lft) ?></td>
        </tr>
        <tr>
            <th><?= __('Rght') ?></th>
            <td><?= $this->Number->format($skillsTree->rght) ?></td>
        </tr>
        <tr>
            <th><?= __('Level') ?></th>
            <td><?= $this->Number->format($skillsTree->level) ?></td>
        </tr>
            <tr>
                <th><?= __('Photo') ?></th>
                <td>
                    <?php if($skillsTree->get('photo_dir') != "") : ?>
                        <?php echo $this->Html->image('../files/skillstree/photo/' . $skillsTree->get('photo_dir') . '/' . $skillsTree->get('photo')); ?>
                    <?php else :?>
                        <h5>No image found</h5>
                    <?php endif;?>
                 </td>
            </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Skills Tree') ?></h4>
        <?php if (!empty($skillsTree->child_skills_tree)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Parent Id') ?></th>
                <th><?= __('Lft') ?></th>
                <th><?= __('Rght') ?></th>
                <th><?= __('Skill Id') ?></th>
                <th><?= __('Level') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($skillsTree->child_skills_tree as $childSkillsTree): ?>
            <tr>
                <td><?= h($childSkillsTree->id) ?></td>
                <td><?= h($childSkillsTree->parent_id) ?></td>
                <td><?= h($childSkillsTree->lft) ?></td>
                <td><?= h($childSkillsTree->rght) ?></td>
                <td><?= h($childSkillsTree->skill_id) ?></td>
                <td><?= h($childSkillsTree->level) ?></td>
                <td><?= h($childSkillsTree->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SkillsTree', 'action' => 'view', $childSkillsTree->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SkillsTree', 'action' => 'edit', $childSkillsTree->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SkillsTree', 'action' => 'delete', $childSkillsTree->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childSkillsTree->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
