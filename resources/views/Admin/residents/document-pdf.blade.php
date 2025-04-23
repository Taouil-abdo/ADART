{{-- resources/views/residents/document-pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resident Document - {{ $resident->fullname }}</title>
    <style>
        /* Reset and base styles */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
            font-size: 12px;
            line-height: 1.4;
            position: relative;
        }
        
        /* Watermark */
        body::before {
            content: "DAR TALIB";
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            font-weight: bold;
            color: #eee;
            z-index: -1;
        }
        
        /* Header styles */
        .header {
            border-bottom: 2px solid #000;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
        }
        .document-id {
            border: 1px solid #000;
            display: inline-block;
            padding: 8px 15px;
            margin-top: 10px;
        }
        
        /* Content area */
        .content {
            padding: 20px;
        }
        
        /* Resident header with photo */
        .resident-header {
            margin-bottom: 25px;
            overflow: hidden;
            border-bottom: 1px solid #000;
            padding-bottom: 15px;
        }
        .resident-header::after {
            content: "";
            display: table;
            clear: both;
        }
        .resident-info {
            float: left;
            width: 70%;
        }
        .resident-photo {
            float: right;
            width: 100px;
            height: 120px;
            border: 1px solid #000;
            text-align: center;
            position: relative;
        }
        .resident-photo img {
            max-width: 100%;
            max-height: 100%;
        }
        .photo-placeholder {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            text-align: center;
        }
        
        /* Status indicator */
        .status {
            display: inline-block;
            padding: 4px 10px;
            border: 1px solid #000;
            font-size: 11px;
            font-weight: bold;
            margin-top: 8px;
        }
        
        /* Section styling */
        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        /* Two-column grid layout */
        .grid {
            overflow: hidden;
        }
        .col {
            float: left;
            width: 48%;
        }
        .col:first-child {
            margin-right: 4%;
        }
        
        /* Field styling */
        .field {
            margin-bottom: 12px;
        }
        .field-label {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 2px;
            margin-top: 0;
            text-transform: uppercase;
        }
        .field-value {
            margin-top: 0;
            margin-bottom: 0;
        }
        
        /* Official stamp */
        .official-section {
            position: relative;
            min-height: 100px;
        }
        .stamp {
            position: absolute;
            right: 50px;
            bottom: 10px;
            font-size: 20px;
            border: 2px solid #000;
            border-radius: 50%;
            padding: 15px 8px;
            transform: rotate(-15deg);
            font-weight: bold;
        }
        
        /* Signature section */
        .signature-section {
            margin-top: 40px;
            overflow: hidden;
            page-break-inside: avoid;
        }
        .signature-box {
            float: left;
            width: 45%;
        }
        .signature-box:first-child {
            margin-right: 10%;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            width: 100%;
            margin-top: 40px;
        }
        
        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #000;
            overflow: hidden;
        }
        .footer-left {
            float: left;
            width: 70%;
            font-size: 10px;
        }
        .footer-right {
            float: right;
            width: 30%;
            text-align: right;
            font-size: 10px;
        }
        
        /* Page number */
        .page-number {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 9px;
        }
        
        /* Page setup */
        @page {
            margin: 0;
        }
        
        /* Table styling */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .info-table th, .info-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            font-size: 11px;
        }
        .info-table th {
            font-weight: bold;
            background-color: #eee;
        }
    </style>
</head>
<body>
    <!-- Document Header -->
    <div class="header">
        <h1>Dar Talib Resident Document</h1>
        <p>Official Resident Information</p>
        <div class="document-id">
            <p style="font-size: 14px; font-weight: bold; margin: 0;">Document #{{ str_pad($resident->id, 5, '0', STR_PAD_LEFT) }}</p>
            <p style="font-size: 10px; margin: 3px 0 0;">Generated on {{ now()->format('F j, Y') }}</p>
        </div>
    </div>
    
    <!-- Document Content -->
    <div class="content">
        <!-- Resident Information with Photo -->
        <div class="resident-header">
            <div class="resident-info">
                <h2 style="margin: 0; font-size: 18px;">{{ $resident->fullname }}</h2>
                <p style="margin: 3px 0 0;">ID: {{ str_pad($resident->id, 5, '0', STR_PAD_LEFT) }}</p>
                <div class="status">
                    {{ ucfirst($resident->status) }}
                </div>
            </div>
            <div class="resident-photo">
                @if(isset($resident->photo) && $resident->photo)
                    <img src="{{ public_path('storage/residents/' . $resident->photo) }}" alt="Resident Photo">
                @else
                    <div class="photo-placeholder">
                        <p>No Photo<br>Available</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Personal Information Section -->
        <div class="section">
            <h3 class="section-title">Personal Information</h3>
            <table class="info-table">
                <tr>
                    <th width="25%">Full Name</th>
                    <td>{{ $resident->fullname }}</td>
                    <th width="25%">Email</th>
                    <td>{{ $resident->email ?: 'Not provided' }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ ucfirst($resident->gender) }}</td>
                    <th>Phone Number</th>
                    <td>{{ $resident->phone ?? 'Not provided' }}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>{{ $resident->age }} years</td>
                    <th>Address</th>
                    <td>{{ $resident->address ?: 'Not provided' }}</td>
                </tr>
                <tr>
                    <th>Birthday</th>
                    <td>{{ $resident->birthday ? date('F j, Y', strtotime($resident->birthday)) : 'Not provided' }}</td>
                    <th>Urgent Contact</th>
                    <td>{{ $resident->urgent_contact ?: 'Not provided' }}</td>
                </tr>
            </table>
        </div>
        
        <!-- Education Information Section -->
        <div class="section">
            <h3 class="section-title">Education Information</h3>
            <div class="grid">
                <div class="col">
                    <div class="field">
                        <p class="field-label">School</p>
                        <p class="field-value">{{ $resident->school ?: 'Not provided' }}</p>
                    </div>
                    <div class="field">
                        <p class="field-label">Major/Specialization</p>
                        <p class="field-value">{{ $resident->major ?? 'Not provided' }}</p>
                    </div>
                </div>
                <div class="col">
                    <div class="field">
                        <p class="field-label">School Level</p>
                        <p class="field-value">{{ $resident->school_level ?: 'Not provided' }}</p>
                    </div>
                    <div class="field">
                        <p class="field-label">Academic Year</p>
                        <p class="field-value">{{ $resident->academic_year ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Residence Information Section -->
        <div class="section">
            <h3 class="section-title">Residence Information</h3>
            <table class="info-table">
                <tr>
                    <th width="25%">Room Number</th>
                    <td>{{ $resident->room ? $resident->room->roomNumber : 'Not assigned' }}</td>
                    <th width="25%">Floor</th>
                    <td>{{ $resident->room ? $resident->room->floor_level : 'Not applicable' }}</td>
                </tr>
                <tr>
                    <th>Room Type</th>
                    <td>{{ $resident->room ? $resident->room->type : 'Not applicable' }}</td>
                    <th>Building</th>
                    <td>{{ $resident->room && isset($resident->room->building) ? $resident->room->building : 'Main Building' }}</td>
                </tr>
                <tr>
                    <th>Date Joined</th>
                    <td>{{ $resident->date_joined ? date('F j, Y', strtotime($resident->date_joined)) : 'Not provided' }}</td>
                    <th>Date Detached</th>
                    <td>{{ $resident->date_detached ? date('F j, Y', strtotime($resident->date_detached)) : 'Not applicable' }}</td>
                </tr>
            </table>
        </div>
        
        <!-- Health Information Section -->
        <div class="section">
            <h3 class="section-title">Health Information</h3>
            <div class="grid">
                <div class="col">
                    <div class="field">
                        <p class="field-label">Health Condition</p>
                        <p class="field-value">{{ $resident->health_condition ?: 'Not provided' }}</p>
                    </div>
                    <div class="field">
                        <p class="field-label">Allergies</p>
                        <p class="field-value">{{ $resident->allergies ?? 'None reported' }}</p>
                    </div>
                </div>
                <div class="col">
                    <div class="field">
                        <p class="field-label">Disease Type</p>
                        <p class="field-value">{{ $resident->DiseaseType ?: 'None' }}</p>
                    </div>
                    <div class="field">
                        <p class="field-label">Medications</p>
                        <p class="field-value">{{ $resident->medications ?? 'None reported' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional Notes Section -->
        <div class="section">
            <h3 class="section-title">Additional Notes</h3>
            <div style="border: 1px solid #000; padding: 10px; min-height: 60px;">
                {{ $resident->notes ?? 'No additional notes.' }}
            </div>
        </div>
        
        <!-- Official Use Section with stamp -->
        <div class="section official-section">
            <h3 class="section-title">For Official Use</h3>
            <div class="grid">
                <div class="col">
                    <div class="field">
                        <p class="field-label">Verified By</p>
                        <p class="field-value">{{ auth()->user()->name ?? '_________________' }}</p>
                    </div>
                </div>
                <div class="col">
                    <div class="field">
                        <p class="field-label">Document Issue Date</p>
                        <p class="field-value">{{ now()->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Stamp -->
            <div class="stamp">OFFICIAL</div>
        </div>
        
        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <p class="field-label">Administrator Signature</p>
                <div class="signature-line"></div>
                <p class="field-label" style="margin-top: 5px;">Date: {{ now()->format('F j, Y') }}</p>
            </div>
            <div class="signature-box">
                <p class="field-label">Resident Signature</p>
                <div class="signature-line"></div>
                <p class="field-label" style="margin-top: 5px;">Date: ____________________</p>
            </div>
        </div>
        
        <!-- Document Footer -->
        <div class="footer">
            <div class="footer-left">
                <p style="margin: 0;">Document generated by Dar Talib Administration</p>
                <p style="margin: 3px 0 0;">This document is confidential and contains personal information. Valid for 3 months from the issue date.</p>
            </div>
            <div class="footer-right">
                <p style="margin: 0;">Generated on</p>
                <p style="margin: 3px 0 0; font-weight: bold;">{{ now()->format('F j, Y') }}</p>
            </div>
        </div>
        
        <!-- Page Number -->
        <div class="page-number">Page 1 of 1</div>
    </div>
</body>
</html>