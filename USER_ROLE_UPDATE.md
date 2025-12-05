# User Role Terminology Update

**Date:** December 5, 2025  
**Status:** Completed

## Overview
Updated the application to reflect the client's requirements for user roles:
- **Supply Officer** (formerly "admin") - Main system administrator who manages inventory and approves requests
- **Employee** (formerly "user") - CSUA (Cagayan State University at Aparri) employees who submit supply requests

## Changes Made

### 1. Database Schema
**File:** `database/migrations/0001_01_01_000000_create_users_table.php`
- Updated `user_type` enum from `['admin', 'user']` to `['supply_officer', 'employee']`
- Default value changed from `'user'` to `'employee'`

**File:** `database/migrations/2025_12_05_000001_update_user_type_terminology.php` (NEW)
- Migration to update existing database records
- Converts `admin` → `supply_officer`
- Converts `user` → `employee`

### 2. Models
**File:** `app/Models/User.php`
- Added new methods: `isSupplyOfficer()` and `isEmployee()`
- Kept legacy methods `isAdmin()` and `isUser()` as aliases for backward compatibility

### 3. Middleware
**File:** `app/Http/Middleware/SupplyOfficerMiddleware.php` (NEW)
- New middleware for Supply Officer access control
- Uses `isSupplyOfficer()` method for authorization

**File:** `app/Http/Middleware/AdminMiddleware.php` (DEPRECATED)
- Marked as deprecated but kept for backward compatibility
- Updated to use `isSupplyOfficer()` internally

**File:** `bootstrap/app.php`
- Added new middleware alias: `'supply.officer'`
- Kept `'admin'` alias for backward compatibility

### 4. Routes
**File:** `routes/web.php`
- Updated route comments to reflect new terminology
- Changed middleware from `'admin'` to `'supply.officer'` for protected routes
- Updated comments for clarity

### 5. Controllers
**File:** `app/Http/Controllers/DashboardController.php`
- Updated method calls from `isAdmin()` to `isSupplyOfficer()`
- Updated comments: "Admin dashboard" → "Supply Officer dashboard"
- Updated comments: "User dashboard" → "Employee dashboard"

### 6. Views
**File:** `resources/views/dashboard/admin.blade.php`
- Updated header from "Administrator Dashboard" to "Supply Officer Dashboard"

**File:** `resources/views/dashboard/user.blade.php`
- Updated header from "User Dashboard" to "Employee Dashboard"

**File:** `resources/views/layouts/app.blade.php`
- Updated footer to display formatted user type (e.g., "Supply Officer" instead of "supply_officer")

### 7. Database Seeders
**File:** `database/seeders/DatabaseSeeder.php`
- Updated default users:
  - Email: `supply.officer@csuaparr.edu.ph` (password: `supply123`)
  - Email: `employee@csuaparr.edu.ph` (password: `employee123`)
- Changed user_type values to new terminology
- Updated departments and positions to reflect roles

**File:** `database/seeders/UpdatedDataSeeder.php`
- Updated variable names: `$admin` → `$supplyOfficer`, `$staff` → `$employee`
- Added fallback for old email patterns during transition
- Updated all references throughout the seeder

**File:** `database/factories/UserFactory.php`
- Changed default `user_type` from `'user'` to `'employee'`

## Backward Compatibility
The update maintains backward compatibility in several ways:
1. Legacy method aliases (`isAdmin()`, `isUser()`) still work
2. AdminMiddleware kept as deprecated but functional
3. Old middleware alias `'admin'` still registered
4. Database migration handles existing data

## Migration Instructions

### For Fresh Installation:
```bash
php artisan migrate:fresh --seed
```

### For Existing Database:
```bash
# Run the new migration to update existing data
php artisan migrate

# If you've already run migrations and need to update data manually:
php artisan tinker
DB::table('users')->where('user_type', 'admin')->update(['user_type' => 'supply_officer']);
DB::table('users')->where('user_type', 'user')->update(['user_type' => 'employee']);
```

## Testing
After migration, verify:
1. Supply Officer can log in and access all admin features
2. Employees can log in and submit supply requests
3. Dashboard displays correct role names
4. Footer shows formatted role name
5. All authorization checks work correctly

## Future Considerations
- Remove deprecated AdminMiddleware in future version
- Remove legacy method aliases (`isAdmin()`, `isUser()`)
- Update any third-party packages or custom code using old terminology
- Consider adding role-based permissions system for finer control

## Notes
- Database column names (like `admin_remarks`) remain unchanged as they are internal references
- The `isAdmin()` and `isUser()` methods are kept for backward compatibility but should be migrated to new methods in custom code
- View files still use `isAdmin()` method calls, which work via the legacy alias
