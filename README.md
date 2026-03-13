# 1. Create database
php bin/console doctrine:database:create

# 2. Setup Ecotone tables
php bin/console ecotone:migration:database:setup --initialize=true

# 3. Initialize projections
php bin/console ecotone:es:initialize-projection products
