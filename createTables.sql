DROP TABLE IF EXISTS QuoteNotes;
DROP TABLE IF EXISTS LineItems;
DROP TABLE IF EXISTS Quotes;
DROP TABLE IF EXISTS Associates;



CREATE TABLE Associates (

 Id INT NOT NULL AUTO_INCREMENT,

 FirstName VARCHAR(100),

 LastName VARCHAR(100),

 UserName VARCHAR(50),

 Password CHAR(8),

 Role CHAR(20),

 StreetAddress VARCHAR(100),

 City VARCHAR(100),

 State CHAR(2),

 Zip INT,

 Email VARCHAR(150),

 AccumulatedCommission DECIMAL(8,2),

 PRIMARY KEY (Id)

);



CREATE TABLE Quotes (

 Id INT NOT NULL AUTO_INCREMENT,

 CustomerId INT NOT NULL,

 ContactCust VARCHAR(150),

 Status VARCHAR(20),

 DiscountPercentage DECIMAL(5,2),

 DiscountAmount DECIMAL(7,2),
 
 TotalPrice DECIMAL(7,2),

 ProcessingDate DATE,

 AssociateId INT NOT NULL,

 PRIMARY KEY (Id),

 FOREIGN KEY (AssociateId) REFERENCES Associates(Id)

);



CREATE TABLE LineItems (

 QuoteId INT NOT NULL,

 ItemNumber INT NOT NULL,

 Quantity INT,

 ItemDescription VARCHAR(250),

 ItemPrice DECIMAL(7,2),

 PRIMARY KEY (QuoteId, ItemNumber),

 FOREIGN KEY (QuoteId) REFERENCES Quotes(Id)

);



CREATE TABLE QuoteNotes (

 QuoteId INT NOT NULL,

 NoteNumber INT NOT NULL,

 Note VARCHAR(500),

 PRIMARY KEY (QuoteId, NoteNumber),

 FOREIGN KEY (QuoteId) REFERENCES Quotes(Id)

);

