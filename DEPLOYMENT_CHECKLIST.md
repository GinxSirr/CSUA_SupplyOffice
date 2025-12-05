# Deployment Checklist - User Role Update

## Pre-Deployment

- [ ] Review all changes in `USER_ROLE_UPDATE.md`
- [ ] Backup existing database
- [ ] Test in development environment first
- [ ] Verify all migrations are present

## Deployment Steps

### Option 1: Fresh Installation (New System)
```bash
# 1. Clear any existing data
php artisan migrate:fresh

# 2. Run seeders with new data
php artisan db:seed

# 3. Test login with new credentials:
#    supply.officer@csuaparr.edu.ph / supply123
#    employee@csuaparr.edu.ph / employee123
```

### Option 2: Update Existing System
```bash
# 1. Run new migration (updates existing user roles)
php artisan migrate

# 2. Verify data was updated
php artisan tinker
# Run: User::pluck('email', 'user_type')
# Should show supply_officer and employee types

# 3. Clear cache
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Test existing user logins
```

### Option 3: Manual Data Update (if migration already run)
```bash
php artisan tinker

# Update user types
DB::table('users')->where('user_type', 'admin')->update(['user_type' => 'supply_officer']);
DB::table('users')->where('user_type', 'user')->update(['user_type' => 'employee']);

# Verify
User::select('id', 'name', 'email', 'user_type')->get();
```

## Post-Deployment Testing

### Test Supply Officer Account
- [ ] Log in with supply officer credentials
- [ ] Dashboard shows "Supply Officer Dashboard"
- [ ] Can access Products menu
- [ ] Can access Requests menu
- [ ] Can access IAR (Inspections) menu
- [ ] Can access PAR (Property Acknowledgments) menu
- [ ] Can approve/reject supply requests
- [ ] Footer shows role as "Supply officer" (formatted)

### Test Employee Account
- [ ] Log in with employee credentials
- [ ] Dashboard shows "Employee Dashboard"
- [ ] Can access "My Requests" menu only
- [ ] Cannot access Products, IAR, or PAR menus
- [ ] Can create new supply requests
- [ ] Can view own request status
- [ ] Footer shows role as "Employee" (formatted)

### Test Authorization
- [ ] Employee cannot access `/products` directly
- [ ] Employee cannot access `/inspections` directly
- [ ] Employee cannot access `/property-acknowledgments` directly
- [ ] Attempting unauthorized access shows 403 error
- [ ] Supply Officer can access all routes

## Rollback Plan (If Issues Occur)

```bash
# Rollback the migration
php artisan migrate:rollback --step=1

# This will revert:
# - supply_officer back to admin
# - employee back to user

# If needed, restore database from backup
```

## Files Modified Summary

### Core Files (8)
1. `database/migrations/0001_01_01_000000_create_users_table.php`
2. `database/migrations/2025_12_05_000001_update_user_type_terminology.php` (NEW)
3. `app/Models/User.php`
4. `app/Http/Middleware/SupplyOfficerMiddleware.php` (NEW)
5. `app/Http/Middleware/AdminMiddleware.php` (UPDATED - Deprecated)
6. `bootstrap/app.php`
7. `routes/web.php`
8. `app/Http/Controllers/DashboardController.php`

### Seeders (3)
9. `database/seeders/DatabaseSeeder.php`
10. `database/seeders/UpdatedDataSeeder.php`
11. `database/factories/UserFactory.php`

### Views (3)
12. `resources/views/dashboard/admin.blade.php`
13. `resources/views/dashboard/user.blade.php`
14. `resources/views/layouts/app.blade.php`

### Documentation (3 NEW)
15. `USER_ROLE_UPDATE.md`
16. `USER_ROLES_GUIDE.md`
17. `DEPLOYMENT_CHECKLIST.md`

## Known Compatibility Notes

- Legacy method calls (`isAdmin()`, `isUser()`) still work
- Old middleware alias `'admin'` still functions
- View files using `isAdmin()` don't need immediate updates
- Database field names like `admin_remarks` remain unchanged (internal use)

## Support Contacts

For issues during deployment:
- Review `USER_ROLE_UPDATE.md` for detailed changes
- Check `USER_ROLES_GUIDE.md` for role information
- Test with provided credentials first
- Verify error logs: `storage/logs/laravel.log`

## Success Criteria

✅ All tests pass  
✅ Supply Officer can manage system  
✅ Employees can submit requests  
✅ No authorization errors  
✅ Role names display correctly  
✅ All existing functionality works  

---
**Last Updated:** December 5, 2025
