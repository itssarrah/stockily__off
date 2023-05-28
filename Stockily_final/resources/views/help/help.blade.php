@extends('layouts.app')

@section('content')
      
        <div class="scrollable-container">
          
        <div class="contentt">
        <main class="main__containerr" id="home">
        <section>
          <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search..." class="search-input">
            <button id="search-button" class="search-button">Search</button>
          </div>
          
          <div id="search-results"></div>
          
        <div class="faq-container" id="content">
          <h1>Account Setting</h1>
          <h1>&nbsp;</h1>
            <div class="faq">
                <h2 class="question">How do I create an account?</h2>
                <div class="answer">
                    <p>&nbsp;<b>To create an account, follow these steps:</b></p>
                    <ol>
                        <li>Go to our website's homepage.</li>
                        <li>Click on the "Sign Up" button.</li>
                        <li>Fill out the registration form with your details.</li>
                        <li>Submit the form and verify your email address.</li>
                        <li>Your account will be created successfully!</li>
                        <h6>&nbsp;</h6>
                    </ol>
                </div>
            </div>
            <div class="faq">
                <h2 class="question">How can I reset my password?</h2>
                <div class="answer">
                    <p>&nbsp;<b>To reset your password, please follow the steps in one of the situations:</b></p>
                    <ul>
                        <li>If you are in your main page (already logged in): Click on the top rightmost icon symbolizing a profile,
                          click on the change password option, do the necessary changes then click the change password button.
                        </li>
                        <li>In the login page: Click on the "Forgot Your Password" link in the top,
                           enter your registered email address, check your email for a password reset link,
                           follow the instructions in the email to reset your password.</li>
                        <h6>&nbsp;</h6>
                    </ul>
                </div>
            </div>
            <div class="faq">
              <h2 class="question">How do I edit my profile?</h2>
              <div class="answer">
                  <p>&nbsp;<b>To edit your profile (change name, email, photo), follow these steps:</b></p>
                  <ol>
                      <li>Once logged in, click on the top righmost icon</li>
                      <li>Select the option "Profile"</li>
                      <li>In your profile page click on "Edit Profile" that's under your name</li>
                      <li>Do the desired changes then click on "Update Profile"</li>
                      <li>Your profil will be updates successfully!</li>
                      <h6>&nbsp;</h6>
                  </ol>
              </div>
            </div>
          <h1>Inventory Management</h1>
          <h1>&nbsp;</h1>
          <div class="faq">
            <h2 class="question">How do I create my virual inventory?</h2>
            <div class="answer">
                <p>&nbsp;<b>To create an inventory, follow these steps:</b></p>
                <ol>
                    <li>On your main page, find in the side bar the "Manage Locations" label</li>
                    <li>Click on it then select "All locations", you'll be directed to LOCATIONS MANAGEMENT page</li>
                    <li>Click on the "Add Location" button on th top left</li>
                    <li>Enter the location name then click the button to submit</li>
                    <li>Now your inventory location is successfully added</li>
                </ol>
              <p>&nbsp;<b>Once the location is created it will be displayed on the LOCATIONS MANAGEMENT
                page. The action column enables you to:</b> </p>
                <ul>
                  <li>Display the products available in that location.</li>
                  <li>Edit the location name</li>
                  <li>Delete the location from your list</li>
                  <h6>&nbsp;</h6>
                </ul>
            </div>
          </div>
         <div class="faq">
          <h2 class="question">How to make a category for products?</h2>
          <div class="answer">
            <p>&nbsp;<b> create an category, follow these steps:</b></p>
            <ol>
                <li>On your main page, find in the side bar the "Manage Categories" label</li>
                <li>Click on it then select "All Categories", you'll be directed to MANAGE YOUR WAREHOUSE CATEGORIES page</li>
                <li>Click on the "Add category" button on th top left</li>
                <li>Enter the category name then click the button to submit</li>
                <li>Now your product category is successfully made</li>
            </ol>
            <p>&nbsp;<b>Once the category is created it will be displayed on the LOCATIONS MANAGEMENT
                page. The action column enables you to: </b></p>
                <ul>
                  <li>Edit the category name</li>
                  <li>Delete the category from your list</li>
                  <h6>&nbsp;</h6>
                </ul>
          </div>
          </div>
         <div class="faq">
         <h2 class="question">How can I add a supplier?</h2>
         <div class="answer">
          <p>&nbsp;<b>Steps for adding a supplier:</b></p>
          <ol>
              <li>On your main page, find in the side bar the "Manage supplier" drop down menu</li>
              <li>Click on it then select "All supplier", you'll be directed to SUPPLIER ALL page</li>
              <li>Click on the "Add supplier" button on th top left</li>
              <li>Enter all the specified supplier information then click the button to submit</li>
              <li>The supplier is now added to your list successfully</li>
          </ol>
          <p>&nbsp;<b>The action column in the table of suppliers on the SUPPLIER ALL page enables you to: </b></p>
              <ul>
                <li>Edit the data of the supplier on that row</li>
                <li>Delete the supplier from the list</li>
                <h6>&nbsp;</h6>
              </ul>
          </div>
          </div>
          <div class="faq">
          <h2 class="question">How to fill the inventory with the products?</h2>
          <div class="answer">
          <p>&nbsp;<b>In order to register your products, follow the steps:</b></p>
          <ol>
              <li>On your main page, find in the side bar the "Manage Product" drop down menu</li>
              <li>Click on it then select "All Products", you'll be directed to MANAGE YOUR PRODUCTS/ITEMS page</li>
              <li>Click on the "Add Product" button on th top left</li>
              <li>Enter the product name and specify the category, location, and supplier from the displayed list of your already added data</li>
              <li>Then click the button to submit</li>
              <li>Now your product is added with the ncessary information</li>
          </ol>
          <p>&nbsp;<b>The action column next to Category column on the table of products enables you to: </b></p>
              <ul>
                <li>Edit the onformation of the product on that row</li>
                <li>Delete the product from the list</li>
                <h6>&nbsp;</h6>
              </ul>
          </div>
          </div>
         <div class="faq">
         <h2 class="question">Managing Stock</h2>
         <div class="answer">
          <p>&nbsp;&nbsp;<b>T</b>he lable on the side menu stating "Manage Stock" includes the reports for the stock, products, and suppliers.</p>
          <p>&nbsp;&nbsp;<b>T</b>he "Stock Report" page includes the list for all the suppliers and products with the details.</p>
          <p>&nbsp;&nbsp;<b>T</b>he list can be printed by clicking on the "Stock Report Print" button located at the top of the list on the left.</p>
          <p>&nbsp;&nbsp;<b>T</b>he "Supplier/Product Wise" label directs to the page containing two reports; one of the suppliers the other for the products.</p>
          <p>&nbsp;&nbsp;<b>I</b>n order to display a report you must first select which one you want to see and that's by selecting one of the options; Supplier Wise Report, Product Wise Report.</p>
          <p>Second enter the desired information (Supplier name for the suppliers, category and name for the product) then click search to display a full report on the specified choice.</p>
          <p>&nbsp;&nbsp;<b>T</b>he reports can be printed or downloaded, two buttons are available for these actions under the report on the right.</p>
         </div>
         </div>
         <h1>&nbsp;</h1>
         <h1>Finances Management</h1>
         <h1>&nbsp;</h1>
         <div class="faq">
         <h2 class="question">Managing Sources</h2>
         <div class="answer">
          <p>&nbsp;&nbsp;<b>T</b>he lable on the side menu stating "Manage your sources" is for tracking the purchases made.</p>
          <p>&nbsp;&nbsp;<b>T</b>he purchase can be added through the specified button on the page and all necessary information can be entered.</p>
          <p>&nbsp;&nbsp;<b>E</b>very added purchase is added in the list of "All source" with the status pending.</p>
          <p>&nbsp;&nbsp;<b>T</b>o confirm a purchase click the "Approved sources" label under the same menu (Manage your sources), the PURCHASE PENDING page will be displayed.</p>
          <p>&nbsp;&nbsp;<b>N</b>avigate to the purchase to be confirmed within the list and validate it in the action column on its row, click approve on the action confirmation window. Now it's approved.</p>
          <p>&nbsp;&nbsp;<b>T</b>o delete a purchase, before validating a purchase navigate to it on the list in the TRACK YOUR STOCK PRODUCTS (All sources) click on the delete button in the action column on its row.</p>
          <p>&nbsp;&nbsp;<b>O</b>n the "Daily sources report" page you can specify A start and an end date to get a full report on the purchases made in that period.</p>
          </div>
          </div>
         <div class="faq">
         <h2 class="question">Managing Invoices</h2>
         <div class="answer">
          <p>&nbsp;&nbsp;<b>T</b>he lable on the side menu stating "Manage Invoice" is for registering the invoices of every purchase.</p>
          <p>&nbsp;&nbsp;<b>T</b>he invoice can be added through the specified button on the page and all necessary information can be entered.</p>
          <p>&nbsp;&nbsp;<b>E</b>very added invoice is added in the list of "INVOICE ALL" with the status pending.</p>
          <p>&nbsp;&nbsp;<b>T</b>o approve the invoice be issued click the "Approved Invoice" label under the same menu (Manage Invoices), a page with the pending invoices will be displayed.</p>
          <p>&nbsp;&nbsp;<b>N</b>avigate to the invoice to be confirmed within the list and validate it in the action column on its row, click approve on the action confirmation window. Now it's approved.</p>
          <p>&nbsp;&nbsp;<b>T</b>o delete an invoice, before the validation navigate to it on the list in the INVOICE ALL (All invoice) click on the delete button in the action column on its row.</p>
          <p>&nbsp;&nbsp;<b>T</b>o print an invoice </p>
          <p>&nbsp;&nbsp;<b>O</b>n the "Daily Invoice Reportt" page you can specify A start and an end date to get a full report Containing all the invoices made in that period.</p>
         </div>
         </div>
         <h1>&nbsp;</h1>
         <h1>Website Help Features</h1>
         <h1>&nbsp;</h1>
         <div class="faq">
         <h2 class="question">Search & Navigation</h2>
         <div class="answer">
          <p>&nbsp;&nbsp;<b>Search bars</b> are available in every page of the website for the user to use.</p>
          <p>&nbsp;&nbsp;<b>A</b>ll pages with lists have a search bar on top on the right to navigate through the elements easily.</p>
          <p>&nbsp;<b>How to use the search bar</b></p>
          <ol>
            <li>Click on the bar on the page in which the element is supposed to be located.</li>
            <li>Write down what search is for (search is case unsensitive; the letters case don't matter).</li>
            <li>Once done, click on the search button next to the bar.</li>
          </ol>
          <p>&nbsp; If matches found the results will be displayed under the bar, otherwise nothing will be displayed.</p>
          <h6>&nbsp;</h6>
         </div>
         </div>
         <div class="faq">
         <h2 class="question">Dashboard</h2>
         <div class="answer">
          <p>&nbsp;&nbsp;<b>The Dashboard</b> of the website is designed to give the users a global view on their inventories.</p>
          <p>&nbsp;&nbsp;<b>F</b>or a friendly design it is compsed of statistical displays and graphical representations of the inventory components.</p>
          <p>&nbsp;<b>The components that the Dashboard displays</b></p>
          <ul>
            <li>Total of inventory products</li>
            <li>Total locations</li>
            <li>Number of employees</li>
            <li>Number of suppliers</li>
          </ul>
          <h6>&nbsp;</h6>
         </div>
         </div>
         <div class="faq">
         <h2 class="question">Customization</h2>
         <div class="answer">
          <p>&nbsp;&nbsp;<b>T</b>he website provides the ability to customize the the profile.</p>
          
          <p>&nbsp;<b>The customizable properties</b></p>
          <ul>
            <li>Inventory full customization</li>
            <li>Edit profile</li>
            <li>Change the email</li>
            <li>Edit employees roles</li>
            <li>Change the screen size (click the square on top rightmost in main page for a full display)</li>
            <li>Dashboard</li>
          </ul>
          <p>&nbsp;&nbsp;<b>I</b>f having problems customizing the mentioned elements consult the above listed question in this page.</p>
          <h6>&nbsp;</h6>
         </div>
         </div>
         <div class="faq">
         <h2 class="question">Terms & legalities</h2>
         <div class="answer">
          <p>&nbsp;&nbsp;<b>R</b>egarding user accessabilities and conditions consult the <a href="/help/terms_of_use">Terms of Use</a> page for details</p>
          
          <p>&nbsp;&nbsp;<b>T</b>he user once registering have to read and accept the website terms and conditions in order to use the website</p>
          <p>&nbsp;&nbsp;<b>F</b>ailing to meet those conditions, would result in banning the user from access to certain features or delete the user's profile.</p>
          <h6>&nbsp;</h6>
         </div>
         </div>
         <h1>&nbsp;</h1>
         <h1>&nbsp;</h1>
         <h1>&nbsp;</h1>
            <!-- Add more questions and answers using the same structure -->
        </div>
        <script src="/help/scripts.js"></script>
        </section>
      </main>
      </div>
      </div>
      

@endsection