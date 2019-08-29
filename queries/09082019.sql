use leiter_crm;

create view order_detail as 
select 
	price_request.id_submit_request
from price_request
left outer join quotation
on quotation.id_request = price_request.id_submit_request
left outer join order_confirmation
on order_confirmation.id_submit_quotation = quotation.id_submit_quotation

select * from detail_quotation;
select * from order_detail;
rename table order_detail to finished_order_detail;
select * from finished_order_detail;
rename table finished_order_detail to detail_finished_order;

use leiter_crm;
select * from detail_order_item;

select * from order_detail;
use leiter_crm;
select * from order_detail;