This is a simple Magento2 extension 

It allows to

  1) Create programmatically mulstiselect attribute badge_label for product, with options Sale, Free Shipping, Best Seller
  2) On productpage of simple product output badge like on image
     if Sale – red background, label Sale
     if Free Shipping – green background, label Free Shipping 
     if Best Seller – blue background, label Best Seller
     if 2 or 3 selected – output all selected badges, one under another

Installation guide
  1. Copy all files into <magento_root_dir>/app folder
  2. Run upgrade script (php.exe bin/magento setup:upgrade)
