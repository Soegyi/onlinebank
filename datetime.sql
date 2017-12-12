ALTER TABLE `transaction`
MODIFY COLUMN TransactionDate DATETIME DEFAULT NOW();
ALTER TABLE deposit
ADD COLUMN DateOfDeposit DATETIME DEFAULT NOW();

CREATE TABLE orderitem(
product VARCHAR(10) NOT NULL PRIMARY KEY,
orderdate DATETIME NOT NULL DEFAULT NOW());

INSERT INTO orderitem(product)
VALUES('bldccdscddh');
SELECT * FROM orderitem

SELECT product,DATE(orderdate) AS Orderdate FROM orderitem

SELECT * FROM orderitem
WHERE DATE(orderdate) BETWEEN '2016/01/26' AND '20160127';

