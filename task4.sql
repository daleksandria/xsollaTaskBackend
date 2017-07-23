select distinct users.game
from users inner join payments
on payments.user_id = users.id
where users.level > 10
group by users.id, users.game
having sum(payments.amount) > 100


