let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;

// End Authentication
let home = require('./components/home.vue').default;

// End Authentication
let storeemployee = require('./components/employee/create.vue').default;
let employees = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;


let storecustomer = require('./components/customer/create.vue').default;
let customer = require('./components/customer/index.vue').default;
let editcustomer = require('./components/customer/edit.vue').default;

let storesupplier = require('./components/supplier/create.vue').default;
let supplier = require('./components/supplier/index.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;

let storecategory = require('./components/category/create.vue').default;
let category = require('./components/category/index.vue').default;
let editcategory = require('./components/category/edit.vue').default;

let storeproduct = require('./components/product/create.vue').default;
let product = require('./components/product/index.vue').default;
let editproduct = require('./components/product/edit.vue').default;

let storeexpense = require('./components/expense/create.vue').default;
let expense = require('./components/expense/index.vue').default;
let editexpense = require('./components/expense/edit.vue').default;

let salary = require('./components/salary/all_employee.vue').default;
let allSalary = require('./components/salary/index.vue').default;
let paysalary = require('./components/salary/create.vue').default;
let viewsalary = require('./components/salary/view.vue').default;
let editsalary = require('./components/salary/edit.vue').default;


let stock = require('./components/product/stock.vue').default;
let editstock = require('./components/product/edit-stock.vue').default;



let pos = require('./components/pos/pointofsale.vue').default;
let order = require('./components/order/order.vue').default;

let vieworder = require('./components/order/view-order.vue').default;
 

let searchorder = require('./components/order/search.vue').default;

// Frontend Here 
let index = require('./components/index.vue').default;




export const routes = [
  // Frontend Router Begins Here 

  { path: '/frontend/index', component: index, name: 'index'},
  { path: '/', component: login, name: '/'},
  { path: '/register', component: register, name: 'register'},
  { path: '/forget', component: forget, name: 'forget'},
  { path: '/logout', component: logout, name: 'logout'},
  { path: '/home', component: home, name: 'home'},

  // Emplyee Route
  { path: '/employee/create', component: storeemployee, name: '/employee/create'},
  { path: '/employees', component: employees, name: 'employees'},
  { path: '/employee/edit/:id', component: editemployee, name: '/employee/edit/'},


  // Customer Route
  { path: '/customer/create', component: storecustomer, name: 'customer/create'},
  { path: '/customer', component: customer, name: 'customer'},
  { path: '/customer/edit/:id', component: editcustomer, name: '/customer/edit/'},

  //suppler Route
 { path: '/supplier/create', component: storesupplier, name: 'supplier/create'},
  { path: '/supplier', component: supplier, name: 'supplier'},
  { path: '/supplier/edit/:id', component: editsupplier, name: 'supplier/edit/'},

// Category Route
{ path: '/category/create', component: storecategory, name: 'category/create'},
  { path: '/category', component: category, name: 'category'},
  { path: '/category/edit/:id', component: editcategory, name: 'category/edit/'},

//product 
  { path: '/product/create', component: storeproduct, name: 'product/create'},
  { path: '/product', component: product, name: 'product'},
  { path: '/product/edit/:id', component: editproduct, name: 'product/edit/'},

//Expense 
  { path: '/expense/create', component: storeexpense, name: 'expense/create'},
  { path: '/expense', component: expense, name: 'expense'},
  { path: '/expense/edit/:id', component: editexpense, name: 'expense/edit/'},

  //product 
  { path: '/salary', component: salary, name: 'salary'},
  { path: '/allsalaries', component: allSalary, name: 'all-salary'},
  { path: '/pay-salary/:id', component: paysalary, name: 'pay-salary'},
  { path: '/view-salary/:id', component: viewsalary, name: 'view-salary'},
  { path: '/edit-salary/:id', component: editsalary, name: 'edit-salary'},

//stock 
  { path: '/stock', component: stock, name: 'stock'},
  { path: '/edit-stock/:id', component: editstock, name: 'edit-stock'},
 
//pos  route
  { path: '/pos', component: pos, name: 'pos'},


  { path: '/order', component: order, name: 'order'},
  { path: '/view-order/:id', component: vieworder, name: 'view-order'},

  { path: '/searchorder', component: searchorder, name: 'searchorder'},

  








]