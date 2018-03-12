CREATE TABLE Calculator 
(
    id              INT(6)      UNSIGNED AUTO_INCREMENT PRIMARY KEY
    ,growType       VARCHAR(30) NOT NULL
    ,numAcres       INT(255)    NOT NULL
    ,vegtables      INT(255)    NOT NULL
    ,orchards       INT(255)    NOT NULL
    ,berries        INT(255)    NOT NULL
    ,vineyards      INT(255)    NOT NULL
    ,herbs          INT(255)    NOT NULL
    ,otherCult      INT(255)    NOT NULL
    ,hire           VARCHAR(5)  NOT NULL
    ,workHire       INT(5)
    ,workHours      INT(50)
    ,annualBudget   INT(255)    NOT NULL
    ,workExpense    INT(255)    NOT NULL
    ,machineExpense INT(255)    NOT NULL
    ,phytoExpense   INT(255)    NOT NULL
    ,otherExpense   INT(255)    NOT NULL
)

CREATE TABLE WaitingList
(
    id          INT(6)      UNSIGNED AUTO_INCREMENT PRIMARY KEY
    ,firstName  VARCHAR(30) NOT NULL
    ,lastName   VARCHAR(30) NOT NULL
    ,email      VARCHAR(30) NOT NULL
    ,business   VARCHAR(30) NOT NULL
    ,farm       VARCHAR(30) 
    ,phoneNum   VARCHAR(30) NOT NULL
    ,address    VARCHAR(50) 
)