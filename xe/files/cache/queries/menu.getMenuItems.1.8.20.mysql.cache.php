<?php if(!defined('__XE__')) exit();
$query = new Query();
$query->setQueryId("getMenuItems");
$query->setAction("select");
$query->setPriority("");

${'menu_srl180_argument'} = new ConditionArgument('menu_srl', $args->menu_srl, 'equal');
${'menu_srl180_argument'}->checkFilter('number');
${'menu_srl180_argument'}->checkNotNull();
${'menu_srl180_argument'}->createConditionValue();
if(!${'menu_srl180_argument'}->isValid()) return ${'menu_srl180_argument'}->getErrorMessage();
if(${'menu_srl180_argument'} !== null) ${'menu_srl180_argument'}->setColumnType('number');
if(isset($args->parent_srl)) {
${'parent_srl181_argument'} = new ConditionArgument('parent_srl', $args->parent_srl, 'equal');
${'parent_srl181_argument'}->checkFilter('number');
${'parent_srl181_argument'}->createConditionValue();
if(!${'parent_srl181_argument'}->isValid()) return ${'parent_srl181_argument'}->getErrorMessage();
} else
${'parent_srl181_argument'} = NULL;if(${'parent_srl181_argument'} !== null) ${'parent_srl181_argument'}->setColumnType('number');

${'sort_index182_argument'} = new Argument('sort_index', $args->{'sort_index'});
${'sort_index182_argument'}->ensureDefaultValue('listorder');
if(!${'sort_index182_argument'}->isValid()) return ${'sort_index182_argument'}->getErrorMessage();

$query->setColumns(array(
new StarExpression()
));
$query->setTables(array(
new Table('`xe_menu_item`', '`menu_item`')
));
$query->setConditions(array(
new ConditionGroup(array(
new ConditionWithArgument('`menu_srl`',$menu_srl180_argument,"equal")
,new ConditionWithArgument('`parent_srl`',$parent_srl181_argument,"equal", 'and')))
));
$query->setGroups(array());
$query->setOrder(array(
new OrderByColumn(${'sort_index182_argument'}, "desc")
));
$query->setLimit();
return $query; ?>