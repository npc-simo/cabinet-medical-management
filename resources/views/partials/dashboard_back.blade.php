@php
    $user = auth()->user();
@endphp

@if($user)
    @php
        $dashboardUrl = match($user->role) {
            'medecin'    => route('medecin.dashboard'),
            'secretaire' => route('secretaire.dashboard'),
            default      => route('patient.dashboard'),
        };
    @endphp

    <div class="back-dashboard-bar">
        <a href="{{ $dashboardUrl }}" class="back-dashboard-btn">
            ← Retour au tableau de bord
        </a>
    </div>

    <style>
        .back-dashboard-bar{
            width:100%;
            box-sizing:border-box;
            padding:10px 40px;
            background:#edf2f7;
            border-bottom:1px solid #e2e8f0;
            display:flex;
            justify-content:flex-start;
        }
        .back-dashboard-btn{
            padding:7px 14px;
            border-radius:999px;
            background:#0A77D5;
            color:#fff;
            font-size:13px;
            font-weight:500;
            text-decoration:none;
        }
        .back-dashboard-btn:hover{
            background:#085ca8;
        }
    </style>
@endif
