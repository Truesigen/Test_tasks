

написать 2 SQL запроса:
1. Выбрать клики у которых точно есть actions
2. Выбрать клики у которых точно нету actions

1.1. $sql = 'SELECT click.* FROM click JOIN actions ON click.id = actions.click_id';

1.2. $sql = 'SELECT * FROM click WHERE id IN (SELECT click_id FROM actions)';

2.1. $sql = 'SELECT click.* FROM click LEFT JOIN actions ON click.id = actions.click_id WHERE actions.event_date IS NULL';

2.2. $sql = 'SELECT * FROM click WHERE id NOT IN (SELECT click_id FROM actions)';


