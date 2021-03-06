<div>
    <?php echo $this->Html->script('jquery.min.js'); ?>
    <?php echo $this->Html->script('knockout.min.js'); ?>
    <?php echo $this->Html->script('app.js'); ?>
    <?php echo $this->Html->css('tree.css'); ?>
</div>
<div data-bind="text: character.name"></div>
<script>
$( document ).ready(function() {
    skillTree.character.populateFromJson();
    skillTree.populateFromJson();
    ko.applyBindings(skillTree);
    console.log(skillTree);
});
</script>
<script id="tree-template" type="text/html">
    <label class="tab" data-bind="attr: { 'id': 'tab' + $index() }">
        <div data-bind="text: name"></div>
        <input type="radio" name="tab"></input>
        <div class="tree"  data-bind="attr: { 'id': 'tree' + $index() }">
            <ul>
                <li class="skill-node colorize-border">
                    <div class="colorize-border" data-bind="text: name"></div>
                    <ul class="colorize-border" data-bind="template: { name: 'skill-template', foreach: children }">
                    </ul>
                </li>
            </ul>
        </div>
    </label>
</script>
<script id="skillTemplate" type="text/html">
    <li class="skill-node">
        <div data-bind="attr: {class: skillTree.character.getClass(id)}">
            <img width=30px height=30px data-bind="attr: {src: skillTree.getURL(photo_dir, photo)}"/>
            <p data-bind="text: name"></p>
            <!-- ko if: skill -->
            <div class="ranks" data-bind="foreach: skill.ranks">
                <div data-bind="attr: {class: skillTree.character.achievedRank(id)}"></div>
            </div>
            <!-- /ko -->
            <div class="description">Placeholder description.</div>
        </div>
        <!-- ko if: children.length > 0 -->
        <ul class="colorize-border" data-bind="template: { name: 'skill-template', foreach: children }">
        </ul>
        <!-- /ko -->
    </li>
</script>
<div class="tree-view" data-bind="template: { name: 'tree-template', foreach: skillTree.treeStructure, afterRender: renderComplete }">
</div>
<div class="fill-background"></div>
