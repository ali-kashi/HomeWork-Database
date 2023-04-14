//فیلتر کردن بر اساس نام
SELECT * FROM `product` WHERE name LIKE "%موبایل%"

//فیلتر کردن بر اساس قیمت
SELECT * FROM `product` WHERE price < 5000000

//فیلتر کردن بر اساس وضعیت آن
SELECT * FROM `product` WHERE status = "active"