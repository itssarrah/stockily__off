/**
  First phase: creting tables
  **
  /


/*creating a table to conatin the whole employee of the company*/
create table Employees (
Employee_ID number,
First_Name varchar(35), 
Last_Name varchar(35), 
Working_Under number /*the id of the manager of this employee,
 the id should be in this manager*/ 
 /* here we re sure that the id of the manager would be
 existing before the id of the employee becoz the manager
 is the one in charge of adding employees*/
 Location_ID number /*to show in which section of the inventroy space this employee is working (optional)*/
);
/*inventory sections or locations in case not all the inventory is stocked in one place */
create table Inventory_Locations(
Location_ID number,/*the location of the some products*/
Category_ID number/* its category, this is a foreign key*/
);

/*this table is for specifying the different mini databases that will show to the employees accordinf to the table inventory_employee*/
create table Inventories (
Role_ID number, /*here the role is specified because each inventory is gonna be linked with set of employees that have that role in common*/
/*an inventroy here is defined as set of products that are granted to be seen or edited by the employees whonhave the role specified*/
Table_ID number /*the tables that are gonna be assigned to that role*/
);

/*product types table */
create table Items (
Table_ID number, 
Item_ID number,
Category_ID number, 
Item_name varchar(30), 
Item_state varchar(10), 
Location_ID number /*optional*/, 
Used_By number /*used by some other employees, so this attribute will hold their id (optional)*/
);

/*category table that each item belongs to some category*/
create table Category (
Category_ID number, 
Category_Name varchar(40), 
Subcategory_Name varchar(40), 
Description varchar(250)
);

/*roles table*/
create table Roles (
Role_ID number, 
Role_Name varchar(40), 
);

/*the roles of the employees table*/
create table Employee_Roles(
Role_ID number, /*the id of the role (foreign key from the table roles)*/
Employee_ID number /* the id of employees working on that inventory*/
);
/* all the products table*/
create table All_Items (
Table_ID number /*a foreign key for table id from the tables items */
/*here is set just to ease the access to see all the tables that are in thet database */
);

/*
 ** Data of the data of the inventory
   */
    create table Employee_activity(
	    Date  TIMESTAMP, 
		Table_ID number, 
		EMP_ID number, 
		Changes varchar(10)
		); /*to fill this table , there would a trigger on each table where it will fill this table after each change*/


    alter database our_database add log file (
	 NAME=DATA_LOG, 
	 FILENAME="C:\Users\sarah\Documents\2EMME ANNEE\FOURTH TERM\Software engineering\SE_PROJECT",
	 SIZE=100MB, 
	 MAXSIZE=1000MB, 
	 FILEGROWTH=50MB
	 ); 
	 
     	 
	 
/*
**
  Second phase: Constraints
   */ 
  alter table Employees add constraints pk_empid primary key(Employee_ID); 
  alter table Employees add constraints fk_lid foreign key (Location_ID) references Inventory_Locations(Location_ID,Category_ID); 
  
  alter table Category add constraints pk_catid primary key(Category_ID)
  
  alter table Inventory_Locations add constraints fk_catid foreign key (Category_ID) references Category(Category_ID); 
  alter table Inventory_Locations add constraints pk_linv primary key(Location_ID,Category_ID); 
  
  alter table Inventories add constraints fk_rlid foreign key (Role_ID) references Roles(Role_ID); 
  alter table Inventories add constraints fk_tabid foreign key(Table_ID) references Items(Table_ID); 
  alter table Inventories add constraints pk_invsid primary key(Role_ID, Table_ID); 
  
  alter table Items add constraints pk_tabID primary key (Table_ID,Item_ID); 
  alter table Items add constraints fk_catID foreign key (Category_ID) references Category(Category_ID); 
  alter table Items add constraints fk_locid foreign key( Location_ID) references Inventory_Locations(Location_ID,Category_ID); 
  alter table Items add constraints fk_usdid foreign key (Used_By) references Employees(Employee_ID);
  
  alter table All_Items add constraints fk_altabid foreign key (Table_ID) references Items(Table_ID); 
  alter table All_Items add constraints pk_allitm primary key(Table_ID); 
  
  alter table Roles add constraints pk_roleid primary key (Role_ID); 
  
  alter table Employee_Roles add constraints fk_rlID foreign key(role_ID) references Roles(role_ID); 
  alter table Employee_Roles add constraints fk_empid foreign key (Employee_ID) references Employees(Employee_ID); 
  alter table Employee_Roles add constraints pk_rlemp primary key(Role_ID, Employee_ID);
  
  alter table Employee_activity  add constraints fk_tid foreign key(Table_ID)references All_Items(Table_ID); 
  alter table Employee_activity add constraints fk_empid foreign key (EMP_ID) references Employee(Employee_ID); 
  
  /**
     Customers accounts and data of the database
	 **/
	 /*
	 ** First part : creating table
	   */
	 /*users table*/
	 create table Accounts (
	 User-ID number,
	 User_Email varchar(148), 
	 User_PWD varchar(100), 
	 User_Role varchar(10)
	 ); 
	 
	 create table User_Activity(
	 Date TIMESTAMP, 
	 Duration number, 
	 User-ID
	 ); 
	 
	
	 
	 /* 
	 **Second part: adding constraints
		*/
	 
	 alter table Accounts add constraints pk_accts primary key( User_Email, User_PWD); 
	 alter table Accounts add constraints chck_rl check (User_Role in ('manager', 'MANAGER', 'USER','user')); 
	 
	 alter table User_Activity add constraints fk_usrid foreign key (User-ID) references Accounts(User-ID); 
	 alter table User_Activity add constraints pk_usrid primary key(User-ID); 