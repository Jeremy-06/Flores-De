# ITCP226 MP Requirements Traceability (Flores-De)

This document maps each requirement to the exact code locations where the functionality is implemented.

Status legend:

- Implemented: Working evidence found in code.
- Partial: Some parts are present, but requirement is not fully satisfied as written.
- Missing: No concrete implementation found.

## MP1 Product/Service (20 pts)

### 1) Product/Service CRUD datatable (8 pts)

Status: Partial

Evidence:

- Product (flower) CRUD is implemented through admin controller/routes:
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L40)
    - [routes/web.php](routes/web.php#L61)
- Admin product listing uses an HTML table with search + pagination (not Yajra DataTables):
    - [resources/views/admin/flowers/index.blade.php](resources/views/admin/flowers/index.blade.php#L35)
    - [resources/views/admin/flowers/index.blade.php](resources/views/admin/flowers/index.blade.php#L91)
- A generated `FlowersDataTable` class exists but appears scaffold-like and not wired to page rendering:
    - [app/DataTables/FlowersDataTable.php](app/DataTables/FlowersDataTable.php#L15)
    - [app/DataTables/FlowersDataTable.php](app/DataTables/FlowersDataTable.php#L72)

### 2) Product/Service CRUDRestore datatable upload a single photo (10 pts)

Status: Implemented (datatable portion is non-Yajra table)

Evidence:

- Soft delete + restore route/action:
    - [routes/web.php](routes/web.php#L63)
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L102)
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L104)
- Main image upload in create/update:
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L52)
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L79)
- Main image input fields in forms:
    - [resources/views/admin/flowers/create.blade.php](resources/views/admin/flowers/create.blade.php#L45)
    - [resources/views/admin/flowers/edit.blade.php](resources/views/admin/flowers/edit.blade.php#L50)
- Soft deletes enabled in migration/model:
    - [database/migrations/2026_03_06_001504_add_soft_deletes_to_products_table.php](database/migrations/2026_03_06_001504_add_soft_deletes_to_products_table.php#L15)
    - [app/Models/Flower.php](app/Models/Flower.php#L14)

### 3) Product/Service CRUDRestore datatable upload/view multiple photos (15 pts)

Status: Implemented

Evidence:

- Multiple image upload handling:
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L57)
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L87)
- Multiple image file inputs:
    - [resources/views/admin/flowers/create.blade.php](resources/views/admin/flowers/create.blade.php#L50)
    - [resources/views/admin/flowers/edit.blade.php](resources/views/admin/flowers/edit.blade.php#L54)
- Gallery display and remove image action:
    - [resources/views/admin/flowers/edit.blade.php](resources/views/admin/flowers/edit.blade.php#L65)
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L108)
- Separate `flower_images` table:
    - [database/migrations/2026_03_12_051000_create_flower_images_table.php](database/migrations/2026_03_12_051000_create_flower_images_table.php#L14)
- Product detail view supports image gallery:
    - [resources/views/shop/show.blade.php](resources/views/shop/show.blade.php#L26)

### 4) Product/Service CRUDRestore datatable upload/view multiple photos + import products on Excel (20 pts)

Status: Implemented

Evidence:

- Import route and controller method:
    - [routes/web.php](routes/web.php#L59)
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L114)
    - [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L119)
- Import form in admin products page:
    - [resources/views/admin/flowers/index.blade.php](resources/views/admin/flowers/index.blade.php#L26)
- Excel import class using heading row:
    - [app/Imports/FlowersImport.php](app/Imports/FlowersImport.php#L7)
    - [app/Imports/FlowersImport.php](app/Imports/FlowersImport.php#L11)
- Excel package dependency installed:
    - [composer.json](composer.json#L14)

## MP2 User CRUD (20 pts)

### 1) User Registration with upload photo (5 pts)

Status: Implemented

Evidence:

- Registration form supports multipart + photo input:
    - [resources/views/auth/register.blade.php](resources/views/auth/register.blade.php#L4)
    - [resources/views/auth/register.blade.php](resources/views/auth/register.blade.php#L31)
- Backend validation and photo storage:
    - [app/Http/Controllers/Auth/RegisteredUserController.php](app/Http/Controllers/Auth/RegisteredUserController.php#L24)
    - [app/Http/Controllers/Auth/RegisteredUserController.php](app/Http/Controllers/Auth/RegisteredUserController.php#L33)
    - [app/Http/Controllers/Auth/RegisteredUserController.php](app/Http/Controllers/Auth/RegisteredUserController.php#L34)

### 2) User update profile and upload photo (5 pts)

Status: Implemented

Evidence:

- Profile form allows photo upload:
    - [resources/views/profile/partials/update-profile-information-form.blade.php](resources/views/profile/partials/update-profile-information-form.blade.php#L16)
    - [resources/views/profile/partials/update-profile-information-form.blade.php](resources/views/profile/partials/update-profile-information-form.blade.php#L28)
- Profile update stores photo and resets email verification if email changed:
    - [app/Http/Controllers/ProfileController.php](app/Http/Controllers/ProfileController.php#L29)
    - [app/Http/Controllers/ProfileController.php](app/Http/Controllers/ProfileController.php#L31)
    - [app/Http/Controllers/ProfileController.php](app/Http/Controllers/ProfileController.php#L33)

### 3) List users on a datatable (5 pts)

Status: Partial

Evidence:

- Admin users list exists with search and pagination:
    - [app/Http/Controllers/Admin/UserController.php](app/Http/Controllers/Admin/UserController.php#L17)
    - [app/Http/Controllers/Admin/UserController.php](app/Http/Controllers/Admin/UserController.php#L24)
    - [resources/views/admin/users/index.blade.php](resources/views/admin/users/index.blade.php#L25)
    - [resources/views/admin/users/index.blade.php](resources/views/admin/users/index.blade.php#L62)
- This is not Yajra DataTables; it is a regular table + Laravel pagination.

### 4) Admin can set user active/inactive and update role (5 pts)

Status: Implemented

Evidence:

- User status and role columns in DB:
    - [database/migrations/2026_02_23_132934_add_role_to_users_table.php](database/migrations/2026_02_23_132934_add_role_to_users_table.php#L15)
    - [database/migrations/2026_03_12_105259_add_photo_status_to_users_table.php](database/migrations/2026_03_12_105259_add_photo_status_to_users_table.php#L16)
- Admin update validation and save:
    - [app/Http/Controllers/Admin/UserController.php](app/Http/Controllers/Admin/UserController.php#L36)
    - [app/Http/Controllers/Admin/UserController.php](app/Http/Controllers/Admin/UserController.php#L37)
- UI fields for role/status:
    - [resources/views/admin/users/edit.blade.php](resources/views/admin/users/edit.blade.php#L20)
    - [resources/views/admin/users/edit.blade.php](resources/views/admin/users/edit.blade.php#L27)

## MP3 Authentication, Email Verification, Route Protection (20 pts)

Status: Partial

Evidence:

- User model requires verification contract:
    - [app/Models/User.php](app/Models/User.php#L8)
- Registration triggers email verification flow:
    - [app/Http/Controllers/Auth/RegisteredUserController.php](app/Http/Controllers/Auth/RegisteredUserController.php#L37)
    - [app/Http/Controllers/Auth/RegisteredUserController.php](app/Http/Controllers/Auth/RegisteredUserController.php#L39)
- Verification routes are configured:
    - [routes/auth.php](routes/auth.php#L39)
    - [routes/auth.php](routes/auth.php#L44)
    - [routes/auth.php](routes/auth.php#L61)
    - [routes/auth.php](routes/auth.php#L62)
- Authenticated area protected by `auth` + `verified` middleware:
    - [routes/web.php](routes/web.php#L35)
- Admin routes protected by `auth` + `admin` middleware and role check:
    - [routes/web.php](routes/web.php#L56)
    - [bootstrap/app.php](bootstrap/app.php#L15)
    - [app/Http/Middleware/AdminMiddleware.php](app/Http/Middleware/AdminMiddleware.php#L13)

Gap note:

- Requirement says "only verified users can login." Current flow allows login first, then verified middleware controls access to protected routes.
    - [routes/auth.php](routes/auth.php#L23)
    - [routes/web.php](routes/web.php#L35)

## MP4 Product Review CRUD (20 pts)

### 1) Only customers who bought can post review/comment/rating (8 pts)

Status: Implemented

Evidence:

- Purchase check before creating review:
    - [app/Http/Controllers/ReviewController.php](app/Http/Controllers/ReviewController.php#L17)
    - [app/Http/Controllers/ReviewController.php](app/Http/Controllers/ReviewController.php#L18)
    - [app/Http/Controllers/ReviewController.php](app/Http/Controllers/ReviewController.php#L19)
- Store route and form:
    - [routes/web.php](routes/web.php#L51)
    - [resources/views/shop/show.blade.php](resources/views/shop/show.blade.php#L78)

### 2) Customers can post and update review/comment/rating (10 pts)

Status: Implemented

Evidence:

- Store and update methods:
    - [app/Http/Controllers/ReviewController.php](app/Http/Controllers/ReviewController.php#L9)
    - [app/Http/Controllers/ReviewController.php](app/Http/Controllers/ReviewController.php#L40)
    - [app/Http/Controllers/ReviewController.php](app/Http/Controllers/ReviewController.php#L48)
- Ownership check on update:
    - [app/Http/Controllers/ReviewController.php](app/Http/Controllers/ReviewController.php#L42)
- Update route and form:
    - [routes/web.php](routes/web.php#L52)
    - [resources/views/shop/show.blade.php](resources/views/shop/show.blade.php#L92)

### 3) List all reviews on a datatable (5 pts)

Status: Implemented

Evidence:

- DataTable service class and server-side filters:
    - [app/DataTables/ReviewsDataTable.php](app/DataTables/ReviewsDataTable.php#L66)
    - [app/DataTables/ReviewsDataTable.php](app/DataTables/ReviewsDataTable.php#L36)
    - [app/DataTables/ReviewsDataTable.php](app/DataTables/ReviewsDataTable.php#L41)
- Admin review index renders DataTable with assets/scripts:
    - [resources/views/admin/reviews/index.blade.php](resources/views/admin/reviews/index.blade.php#L12)
    - [resources/views/admin/reviews/index.blade.php](resources/views/admin/reviews/index.blade.php#L18)
    - [resources/views/admin/reviews/index.blade.php](resources/views/admin/reviews/index.blade.php#L118)

### 4) Administrator can delete user reviews (5 pts)

Status: Implemented

Evidence:

- Delete route and controller:
    - [routes/web.php](routes/web.php#L66)
    - [app/Http/Controllers/Admin/ReviewController.php](app/Http/Controllers/Admin/ReviewController.php#L16)
- Delete action button in DataTable row renderer:
    - [app/DataTables/ReviewsDataTable.php](app/DataTables/ReviewsDataTable.php#L28)

## MP5 Validation (15 pts)

Status: Implemented

Evidence:

- Product add validation:
    - [app/Http/Requests/StoreFlowerRequest.php](app/Http/Requests/StoreFlowerRequest.php#L17)
    - [app/Http/Requests/StoreFlowerRequest.php](app/Http/Requests/StoreFlowerRequest.php#L22)
    - [app/Http/Requests/StoreFlowerRequest.php](app/Http/Requests/StoreFlowerRequest.php#L23)
- Product edit validation:
    - [app/Http/Requests/UpdateFlowerRequest.php](app/Http/Requests/UpdateFlowerRequest.php#L17)
    - [app/Http/Requests/UpdateFlowerRequest.php](app/Http/Requests/UpdateFlowerRequest.php#L22)
    - [app/Http/Requests/UpdateFlowerRequest.php](app/Http/Requests/UpdateFlowerRequest.php#L23)
- Registration validation:
    - [app/Http/Controllers/Auth/RegisteredUserController.php](app/Http/Controllers/Auth/RegisteredUserController.php#L21)
    - [app/Http/Controllers/Auth/RegisteredUserController.php](app/Http/Controllers/Auth/RegisteredUserController.php#L25)
- Profile validation:
    - [app/Http/Requests/ProfileUpdateRequest.php](app/Http/Requests/ProfileUpdateRequest.php#L19)
    - [app/Http/Requests/ProfileUpdateRequest.php](app/Http/Requests/ProfileUpdateRequest.php#L22)

## MP6 Filter (15 pts)

### 1) Apply filter when searching products/services

Status: Implemented

Evidence:

- Shop query applies category, price, and search filters:
    - [app/Http/Controllers/ShopController.php](app/Http/Controllers/ShopController.php#L17)
    - [app/Http/Controllers/ShopController.php](app/Http/Controllers/ShopController.php#L25)
    - [app/Http/Controllers/ShopController.php](app/Http/Controllers/ShopController.php#L28)
    - [app/Http/Controllers/ShopController.php](app/Http/Controllers/ShopController.php#L32)
- Filter UI:
    - [resources/views/shop/index.blade.php](resources/views/shop/index.blade.php#L33)
    - [resources/views/shop/index.blade.php](resources/views/shop/index.blade.php#L44)
    - [resources/views/shop/index.blade.php](resources/views/shop/index.blade.php#L45)

### 2) Filter by price (10 pts)

Status: Implemented

Evidence:

- Controller numeric range filter:
    - [app/Http/Controllers/ShopController.php](app/Http/Controllers/ShopController.php#L25)
    - [app/Http/Controllers/ShopController.php](app/Http/Controllers/ShopController.php#L28)
- Price inputs:
    - [resources/views/shop/index.blade.php](resources/views/shop/index.blade.php#L44)
    - [resources/views/shop/index.blade.php](resources/views/shop/index.blade.php#L45)

### 3) Filter by price and category/brand/type (15 pts)

Status: Partial

Evidence:

- Price + category are implemented:
    - [app/Http/Controllers/ShopController.php](app/Http/Controllers/ShopController.php#L17)
    - [resources/views/shop/index.blade.php](resources/views/shop/index.blade.php#L17)
- Brand/type specific fields and filtering logic are not present in current schema/controller.

## MP7 Charts (15 pts)

Status: Implemented

Evidence:

- Yearly sales aggregation (backend):
    - [app/Http/Controllers/Admin/DashboardController.php](app/Http/Controllers/Admin/DashboardController.php#L27)
    - [app/Http/Controllers/Admin/DashboardController.php](app/Http/Controllers/Admin/DashboardController.php#L35)
- Date-range sales bar chart (backend + date picker):
    - [app/Http/Controllers/Admin/DashboardController.php](app/Http/Controllers/Admin/DashboardController.php#L51)
    - [app/Http/Controllers/Admin/DashboardController.php](app/Http/Controllers/Admin/DashboardController.php#L55)
    - [resources/views/admin/dashboard.blade.php](resources/views/admin/dashboard.blade.php#L79)
    - [resources/views/admin/dashboard.blade.php](resources/views/admin/dashboard.blade.php#L195)
- Product sales contribution pie chart:
    - [app/Http/Controllers/Admin/DashboardController.php](app/Http/Controllers/Admin/DashboardController.php#L39)
    - [resources/views/admin/dashboard.blade.php](resources/views/admin/dashboard.blade.php#L166)
- Chart rendering with Chart.js:
    - [resources/views/admin/dashboard.blade.php](resources/views/admin/dashboard.blade.php#L127)
    - [resources/views/admin/dashboard.blade.php](resources/views/admin/dashboard.blade.php#L132)
    - [resources/views/admin/dashboard.blade.php](resources/views/admin/dashboard.blade.php#L167)

## MP8 Search (15 pts)

### 1) Search products on homepage using LIKE query (8 pts)

Status: Implemented

Evidence:

- Home search uses `like` query conditions:
    - [app/Http/Controllers/HomeController.php](app/Http/Controllers/HomeController.php#L22)
    - [app/Http/Controllers/HomeController.php](app/Http/Controllers/HomeController.php#L23)
    - [app/Http/Controllers/HomeController.php](app/Http/Controllers/HomeController.php#L24)
- Search UI on homepage:
    - [resources/views/home.blade.php](resources/views/home.blade.php#L12)
    - [resources/views/home.blade.php](resources/views/home.blade.php#L35)

### 2) Search products on homepage using model search (10 pts)

Status: Missing

Evidence:

- No dedicated model-level search method found (for example custom `scopeSearch` or similar reusable model search API).
- Current implementation is controller-level query composition:
    - [app/Http/Controllers/HomeController.php](app/Http/Controllers/HomeController.php#L19)

### 3) Search products on homepage using Laravel Scout with pagination (15 pts)

Status: Missing

Evidence:

- `laravel/scout` package is not in dependencies:
    - [composer.json](composer.json#L8)
- No Scout traits/usages (`Searchable`, `Model::search()`) found in codebase.

## Term Test Lab (30 pts)

### 1) Transaction; send email after completed transaction (10 pts)

Status: Implemented

Evidence:

- Transaction boundaries in checkout:
    - [app/Http/Controllers/CheckoutController.php](app/Http/Controllers/CheckoutController.php#L50)
    - [app/Http/Controllers/CheckoutController.php](app/Http/Controllers/CheckoutController.php#L77)
    - [app/Http/Controllers/CheckoutController.php](app/Http/Controllers/CheckoutController.php#L87)
- Order confirmation email sent after commit:
    - [app/Http/Controllers/CheckoutController.php](app/Http/Controllers/CheckoutController.php#L81)

### 2) Admin can update transaction status (5 pts)

Status: Implemented

Evidence:

- Status update validation and persistence:
    - [app/Http/Controllers/Admin/OrderController.php](app/Http/Controllers/Admin/OrderController.php#L42)
    - [app/Http/Controllers/Admin/OrderController.php](app/Http/Controllers/Admin/OrderController.php#L45)
- Admin UI form to update status:
    - [resources/views/admin/orders/show.blade.php](resources/views/admin/orders/show.blade.php#L82)
    - [resources/views/admin/orders/show.blade.php](resources/views/admin/orders/show.blade.php#L86)

### 3) Send email after status update (5 pts)

Status: Implemented

Evidence:

- Mail send in admin order update:
    - [app/Http/Controllers/Admin/OrderController.php](app/Http/Controllers/Admin/OrderController.php#L49)
    - [app/Http/Controllers/Admin/OrderController.php](app/Http/Controllers/Admin/OrderController.php#L50)
- Mailable setup:
    - [app/Mail/OrderStatusUpdated.php](app/Mail/OrderStatusUpdated.php#L26)
    - [app/Mail/OrderStatusUpdated.php](app/Mail/OrderStatusUpdated.php#L33)

### 4) Attach PDF receipt with customer and order details (10 pts)

Status: Implemented

Evidence:

- PDF attachment generated in mailable:
    - [app/Mail/OrderPlaced.php](app/Mail/OrderPlaced.php#L38)
    - [app/Mail/OrderPlaced.php](app/Mail/OrderPlaced.php#L40)
    - [app/Mail/OrderPlaced.php](app/Mail/OrderPlaced.php#L43)
- Receipt PDF template includes order/customer/details/items/total:
    - [resources/views/pdf/receipt.blade.php](resources/views/pdf/receipt.blade.php#L32)
    - [resources/views/pdf/receipt.blade.php](resources/views/pdf/receipt.blade.php#L36)
    - [resources/views/pdf/receipt.blade.php](resources/views/pdf/receipt.blade.php#L38)
    - [resources/views/pdf/receipt.blade.php](resources/views/pdf/receipt.blade.php#L40)
    - [resources/views/pdf/receipt.blade.php](resources/views/pdf/receipt.blade.php#L71)

## Quiz 4 UI Design (15 pts)

Status: Implemented (front-end pages and theme present)

Evidence:

- Home page design and hero/search layout:
    - [resources/views/home.blade.php](resources/views/home.blade.php#L5)
    - [resources/views/home.blade.php](resources/views/home.blade.php#L12)
- Shop/product views styling and responsive layout:
    - [resources/views/shop/index.blade.php](resources/views/shop/index.blade.php#L8)
    - [resources/views/shop/show.blade.php](resources/views/shop/show.blade.php#L8)
- Admin dashboard visual charts/cards:
    - [resources/views/admin/dashboard.blade.php](resources/views/admin/dashboard.blade.php#L8)

## U1 Database Design / Migration / Seeding (20 pts)

### 1) At least 2NF design (10 pts)

Status: Implemented

Evidence:

- Normalized tables with relationships:
    - Users table: [database/migrations/2026_02_20_000000_create_users_table.php](database/migrations/2026_02_20_000000_create_users_table.php#L14)
    - Categories table: [database/migrations/2026_02_23_132740_create_categories_table.php](database/migrations/2026_02_23_132740_create_categories_table.php#L14)
    - Flowers table with category FK: [database/migrations/2026_02_23_132838_create_products_table.php](database/migrations/2026_02_23_132838_create_products_table.php#L17)
    - Orders table with user FK: [database/migrations/2026_02_23_132848_create_orders_table.php](database/migrations/2026_02_23_132848_create_orders_table.php#L16)
    - Order items table with order/flower FKs: [database/migrations/2026_02_23_132914_create_order_items_table.php](database/migrations/2026_02_23_132914_create_order_items_table.php#L13)
    - Reviews table with uniqueness per user+product: [database/migrations/2026_03_22_142803_create_reviews_table.php](database/migrations/2026_03_22_142803_create_reviews_table.php#L21)

### 2) Create DB using migration scripts (5 pts)

Status: Implemented

Evidence:

- Core migrations for all entities exist:
    - [database/migrations/2026_02_20_000000_create_users_table.php](database/migrations/2026_02_20_000000_create_users_table.php#L12)
    - [database/migrations/2026_02_23_132740_create_categories_table.php](database/migrations/2026_02_23_132740_create_categories_table.php#L12)
    - [database/migrations/2026_02_23_132838_create_products_table.php](database/migrations/2026_02_23_132838_create_products_table.php#L13)
    - [database/migrations/2026_02_23_132848_create_orders_table.php](database/migrations/2026_02_23_132848_create_orders_table.php#L12)
    - [database/migrations/2026_02_23_132914_create_order_items_table.php](database/migrations/2026_02_23_132914_create_order_items_table.php#L9)

### 3) Seed all database tables (5 pts)

Status: Implemented

Evidence:

- Seeder orchestration:
    - [database/seeders/DatabaseSeeder.php](database/seeders/DatabaseSeeder.php#L12)
    - [database/seeders/DatabaseSeeder.php](database/seeders/DatabaseSeeder.php#L16)
- Example user seed data (admin/customer):
    - [database/seeders/AdminUserSeeder.php](database/seeders/AdminUserSeeder.php#L12)
    - [database/seeders/AdminUserSeeder.php](database/seeders/AdminUserSeeder.php#L19)

## U2 Functional Completeness / Complexity / Added Features (10 pts)

Status: Implemented

Evidence of added features beyond basic CRUD:

- Excel import for products: [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L119)
- Multi-image gallery per product: [app/Http/Controllers/Admin/FlowerController.php](app/Http/Controllers/Admin/FlowerController.php#L57)
- PDF receipts and email attachment: [app/Mail/OrderPlaced.php](app/Mail/OrderPlaced.php#L40)
- Sales analytics dashboard (bar/pie/date-range): [app/Http/Controllers/Admin/DashboardController.php](app/Http/Controllers/Admin/DashboardController.php#L27)

## Program Execution (Errors) (10 pts)

Status: Not validated in this document

Note:

- This traceability report is static code evidence mapping. Runtime testing results are not included here.

## Project Contribution (10 pts)

Status: Not derivable from code alone

Note:

- Contribution grading usually needs git history/team logs, not only source code content.

## Quick Summary of Notable Gaps

1. Product/User/Order listing pages use regular tables + Laravel pagination, not fully wired Yajra DataTables in all modules.
2. MP8 "model search" variant is not separately implemented as a model-level reusable search API.
3. MP8 Laravel Scout search with pagination is missing (no Scout dependency/usages).
4. MP3 wording "only verified users can login" is stricter than current flow; current implementation restricts access to verified-only routes after login.
