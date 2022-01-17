var expenseAuth= localStorage.getItem('payload');
if(expenseAuth===null)
{
  window.location.replace('login.php')
}
