SELECT 
    resultlist.is_month as 'Месяц', links.link_name as 'Ссылка', resultlist.visit_count as 'Кол-во переходов', resultlist.position_on_top as 'Позиция в топе месяца по переходам' 
FROM (SELECT 
    *, row_number() over (partition by resultlist.is_month order by resultlist.visit_count DESC) as 'position_on_top' 
FROM (SELECT 
        YEAR(clicks.click_date) + '-' + MONTH(clicks.click_date) as 'is_month', clicks.link_id, count(*) as 'visit_count' 
FROM 
    clicks GROUP BY is_month, clicks.link_id) as resultlist ) as resultlist INNER JOIN links 
WHERE resultlist.link_id = links.id ORDER BY resultlist.is_month DESC, resultlist.position_on_top ASC;