# Customer-Discount
Magento 2 By Default Does not allows to apply Discount code on Unique Customers, So this Module will help those who wants to send Special Discount Code or Special Coupon Code for particular Customer according to there need.
   
By This Module Admin can Set Discount Coupon Code for particular Customer on Checkout.

## Admin Access.

- Easy Admin Access.
- Admin Will Easiy set Cart Discount Code On each Customer according to there Group Type.
- Admin Can Enable And Disable this Functionality after which the selected coupon will be available for every customers.

## Frontend

- Only Unique Customer Can Use this coupon for there shopping if Admin set this for them.

## Steps To Follow.
- Simply Download The Module
- Place it in Root/app/code
- Make sure module is Enbaled
- Now run Upgrade, Deploy command.
- Flush Chache and give permission.
Now Login With Admin First and Create a coupon code by Going through 
- Marketing-> CartRule Here create coupon as per you need.
- Then click on CustomerDiscount From Menu.
- There Click on Create Discount
- Fill the General Information and Customer Information(Select Customer ad per there group).

### Note:: Here Only those Coupon codes will display which are created and set as per there customer group while creating in cart rule.
- Select The coupon code and Customers.
- Congrats You are Done.

Now That Cart Rule Coupon Will only apply to the selected Customer And on others it will show an Error "The coupon code couldn't be applied. Verify the coupon code and try again."   

