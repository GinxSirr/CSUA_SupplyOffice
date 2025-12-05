# BAC Office Supply System - User Roles

## System Users

### 1. Supply Officer (Main Administrator)
- **Role:** `supply_officer`
- **Access:** Full system access
- **Responsibilities:**
  - Manage product inventory
  - Approve/reject supply requests
  - Create Inspection and Acceptance Reports (IAR)
  - Manage Property Acknowledgment Receipts (PAR)
  - View all system statistics and reports

**Test Credentials:**
- Email: `supply.officer@csuaparr.edu.ph`
- Password: `supply123`

### 2. Employee (CSUA Staff)
- **Role:** `employee`
- **Access:** Limited to own requests
- **Responsibilities:**
  - Submit supply requests
  - View own request status
  - Receive notifications about request updates
  - View available products

**Test Credentials:**
- Email: `employee@csuaparr.edu.ph`
- Password: `employee123`

## Key Features by Role

### Supply Officer Dashboard
- Total products count
- Low stock alerts
- Pending requests overview
- Recent requests list
- Recent inspections
- Full navigation menu (Products, Requests, IAR, PAR)

### Employee Dashboard
- Pending requests count
- Approved requests count
- Unread notifications
- My supply requests list
- Simplified navigation (My Requests only)

## Code Reference

### Checking User Role
```php
// New methods (recommended)
if (auth()->user()->isSupplyOfficer()) {
    // Supply officer specific code
}

if (auth()->user()->isEmployee()) {
    // Employee specific code
}

// Legacy methods (still work)
if (auth()->user()->isAdmin()) {
    // Also checks for supply officer
}
```

### Route Protection
```php
// Protect routes for supply officer only
Route::middleware('supply.officer')->group(function () {
    // Supply officer routes
});

// Or use legacy alias
Route::middleware('admin')->group(function () {
    // Also works
});
```

### Available Middleware
- `supply.officer` - Requires Supply Officer role (recommended)
- `admin` - Legacy alias for supply officer (deprecated)

## Database Structure
The `users` table includes:
- `user_type` ENUM: `'supply_officer'` or `'employee'`
- `department`: User's department/office
- `position`: User's job position
- `is_active`: Account active status
