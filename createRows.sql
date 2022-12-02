/*Associate Table*/
INSERT INTO Associates 
(Id, FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
(1, 'Jordyn', 'Herman', 'JordH', 'Assoc1', 'sales',
'857 York St.', 'Coventry', 'RI', 02816, 'associate1@gmail.com', 0.0);

INSERT INTO Associates 
(FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
('Devon', 'Chang', 'DevoC', 'Assoc2', 'sales',
'80 Elmwood St.', 'Shrewsbury', 'MA', 01545, 'associate2@gmail.com', 0.0);

INSERT INTO Associates 
(FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
('Alisa', 'Hess', 'AlisH', 'Assoc3', 'sales',
'94 Hamilton Rd.', 'Rahway', 'NJ', 07065, 'associate3@gmail.com', 0.0);

INSERT INTO Associates 
(FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
('Jaime', 'Church', 'JaimC', 'Assoc4', 'admin',
'882 Thorne Rd', 'lafayette', 'IN', 47905, 'associate4@gmail.com', 0.0);

INSERT INTO Associates 
(FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
('Ayden', 'French', 'AydeF', 'Assoc5', 'admin',
'35 St Louis Ave.', 'Corpus Christi', 'TX', 78418, 'associate5@gmail.com', 0.0);

INSERT INTO Associates 
(FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
('Curtis', 'Vance', 'CurtV', 'Assoc6', 'admin',
'45 S. Mechanic Road', 'Far Rockaway', 'NY', 11691, 'associate6@gmail.com', 0.0);

INSERT INTO Associates 
(FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
('Sonia', 'Ford', 'SoniF', 'Assoc7', 'manager',
'56 Albany Ave.', 'Round Lake', 'IL', 60073, 'associate7@gmail.com', 0.0);

INSERT INTO Associates 
(FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
('Layla', 'Krueger', 'LaylK', 'Assoc8', 'manager',
'8062 Pilgrim Rd.', 'Alliance', 'OH', 44601, 'associate8@gmail.com', 0.0);

INSERT INTO Associates 
(FirstName, LastName, UserName, Password, Role, 
StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
VALUES
('India', 'Waller', 'IndiW', 'Assoc9', 'manager',
'54 Cherry Hill St.', 'Erie', 'PA', 16506, 'associate9@gmail.com', 0.0);



/*Quote Table*/
INSERT INTO Quotes 
(Id, CustomerId, ContactCust, Status, DiscountPercentage,
DiscountAmount, TotalPrice, ProcessingDate, AssociateId) 
VALUES
(1, 4, "info@insight-tech.com", "finalized", 10, 124.24, 1118.13, '2022/11/21', 1);

INSERT INTO Quotes 
(CustomerId, ContactCust, Status, DiscountPercentage,
DiscountAmount, TotalPrice, ProcessingDate, AssociateId)  
VALUES
(9, "Susan Powers @ 1-614-556-4266", "in-process", 5, 79.21, NULL, '2022/11/09', 8);

INSERT INTO Quotes 
(CustomerId, ContactCust, Status, DiscountPercentage,
DiscountAmount, TotalPrice, ProcessingDate, AssociateId)  
VALUES
(10, "www.johndeere.com", "in-process", 5, 8.62, NULL, '2022/11/24', 7);

INSERT INTO Quotes 
(CustomerId, ContactCust, Status, DiscountPercentage,
DiscountAmount, TotalPrice, ProcessingDate, AssociateId) 
VALUES
(59, "+47 2267 3215", "in-process", 10, 9.75, NULL, '2022/11/20', 3);

INSERT INTO Quotes 
(CustomerId, ContactCust, Status, DiscountPercentage,
DiscountAmount, TotalPrice, ProcessingDate, AssociateId)  
VALUES
(93, "(604) 555-4555", "in-process", 15, 24.99, NULL, '2022/11/22', 2);



/*LineItems Table*/
INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(1, 1, 2, "windshield w/ polymer", 178.76);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(1, 2, 1, "wiper blade pair", 23.37);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(1, 3, 2, "solenoid", 36.58);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(1, 4, 3, "tiresome mettle", 157.46);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(1, 5, 1, "bucket seat pair", 315.94);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(2, 6, 1, "5 point harnes", 177.79);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(2, 7, 1, "turbo intake valve", 659.83);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(2, 8, 1, "supercharger", 711.14);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(2, 9, 5,  "inter cooler sweep", 2.00);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(2, 10, 1,  "gas cap-chrome", 25.38);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(3, 11, 2, "chrome brake pedals kit-manual", 45.71);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(3, 12, 1, "chrome brake pedals kit-automatic", 41.65);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(3, 13, 3,  "intel inside window decal", 2.03);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(3, 14, 10, "niu alumni window decal", 1.85);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(3, 15, 8, "air freshener-lemon", 1.85);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(4, 16, 7, "air freshener-cherry", 1.85);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(4, 17, 10, "air freshener-new car smell", 2.06);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(4, 18, 1, "cargo net (new model)", 25.36);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(4, 19, 1, "trunk liner", 25.38);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(4, 20, 1, "floor mat-driver side", 13.21);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(5, 21, 1, "floor mat-passenger side", 13.21);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(5, 22, 1, "car detail kit", 88.38);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(5, 23, 1, "tachometer", 30.48);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(5, 24, 1, "speedometer mph edition", 34.55);

INSERT INTO LineItems
(QuoteId, ItemNumber, Quantity, ItemDescription, ItemPrice)
VALUES
(5, 25, 0, "gps navigation", 152.39);



/*QuoteNotes tables*/
INSERT INTO QuoteNotes
(QuoteId, NoteNumber, Note)
VALUES
(1, 1, "Military Discount");

INSERT INTO QuoteNotes
(QuoteId, NoteNumber, Note)
VALUES
(2, 1, "Requested Fast Delivery");


INSERT INTO QuoteNotes
(QuoteId, NoteNumber, Note)
VALUES
(1, 2, "Cheque Payment");

INSERT INTO QuoteNotes
(QuoteId, NoteNumber, Note)
VALUES
(2, 2, "Abroad Delivery");

INSERT INTO QuoteNotes
(QuoteId, NoteNumber, Note)
VALUES
(4, 1, "Student Discount");