<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StaffController extends Controller {
    public function index() {
        $staffs = User::where('role', 'staff')->get();
        return view('staff.dashboard', compact('staffs'));
    }
    public function edit($id)
    {
        $staff = User::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);
        $staff->update($request->only(['name', 'email']));
        return redirect()->route('staff.dashboard')->with('success', 'Cập nhật nhân viên thành công!');
    }

    public function destroy($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();
        return redirect()->route('staff.dashboard')->with('success', 'Xóa nhân viên thành công!');
    }
}

