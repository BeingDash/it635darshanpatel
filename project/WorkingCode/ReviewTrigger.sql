DELIMITER //

CREATE TRIGGER review_after_insert
after INSERT
   ON restaurantreview 
   FOR EACH ROW

BEGIN 

    If new.review is null or new.review = '' then 
	delete from restaurantreview where review is null or review = '';
    End if;

END; //

DELIMITER ;
