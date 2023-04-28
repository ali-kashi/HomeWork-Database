SELECT product.name FROM `product` INNER JOIN users ON product.uid = users.id WHERE users.name LIKE '%علی%';
