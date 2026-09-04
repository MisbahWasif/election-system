@extends('frontend.layout.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/result.css') }}">

@php
    // Sabse zyada votes wale candidate ke votes nikal liye (bar chart ki height calculate karne ke liye)
    $maxVotes = $candidates->max('votes_count') ?: 1;

    // Bar chart ke liye rang cycle karenge (5 colors hain, 6th candidate pe wapis pehla color)
    $barColors = ['bar-green', 'bar-blue', 'bar-purple', 'bar-orange', 'bar-red'];
@endphp

<div class="page-wrapper">

    <!-- TOP ROW: Heading + Election Name -->
    <div class="top-row">
        <div class="page-heading">
            <h1>Election Results</h1>
            <p>{{ $election->title }} — Detailed vote distribution and results.</p>
        </div>
    </div>

    <!-- STATS ROW -->
    <div class="stats-row">

        <div class="stat-card">
            <div class="stat-icon icon-green">
                <i class="fa-solid fa-box-ballot"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Votes</span>
                <span class="stat-number green">{{ $totalVotes }}</span>
                <span class="stat-sub">Valid votes cast</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-orange">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Winner Candidate</span>
                <span class="stat-number navy">{{ $totalVotes > 0 ? $winner->name : 'N/A' }}</span>
                <span class="stat-sub">{{ $totalVotes > 0 ? $winner->party : 'No votes yet' }}</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-blue">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Candidates</span>
                <span class="stat-number navy">{{ $candidates->count() }}</span>
                <span class="stat-sub">Contested candidates</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-lightblue">
                <i class="fa-solid fa-flag"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Election Status</span>
                <span class="stat-number blue">{{ ucfirst($election->status) }}</span>
                <span class="stat-sub">{{ $election->end_date }}</span>
            </div>
        </div>

    </div>

    @if ($candidates->isEmpty())

        <div class="table-section">
            <p>No candidates in this election yet.</p>
        </div>

    @else

        <!-- WINNER BOX -->
        <div class="winner-box">
            <div class="winner-header">
                <i class="fa-solid fa-trophy"></i>
                <span>Winner</span>
            </div>

            <div class="winner-content">

                <div class="winner-left">
                    <!-- Photo ki jagah initials wala avatar (kyun ke real photos nahi hain) -->
                    <div class="winner-photo" style="background:#2541b2; color:white; display:flex; align-items:center; justify-content:center; font-size:28px; font-weight:700;">
                        {{ strtoupper(substr($winner->name, 0, 1)) }}
                    </div>

                    <div class="winner-info">
                        <h2>{{ $winner->name }}</h2>
                        <p>{{ $winner->party }}</p>
                        <div class="party-symbol">
                            <span style="font-size:22px">{{ $winner->symbol }}</span>
                        </div>
                    </div>
                </div>

                <div class="winner-votes">
                    <span class="votes-label">Total Votes</span>
                    <span class="votes-number">{{ $winner->votes_count }}</span>
                    <span class="votes-percent">
                        {{ $totalVotes > 0 ? round(($winner->votes_count / $totalVotes) * 100, 1) : 0 }}% of total votes
                    </span>
                </div>

                <div class="winner-badge">
                    <div class="laurel">
                        <span class="laurel-text">Winner</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- BAR CHART -->
        <div class="chart-section">
            <div class="chart-header">
                <div class="section-title">
                    <i class="fa-solid fa-chart-bar"></i>
                    Vote Distribution
                </div>
            </div>

            <div class="bar-chart">
                @foreach ($candidates as $index => $candidate)
                    @php
                        $percent = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 1) : 0;
                        $barHeight = $maxVotes > 0 ? round(($candidate->votes_count / $maxVotes) * 220) : 0;
                        $color = $barColors[$index % count($barColors)];
                    @endphp
                    <div class="bar-col">
                        <span class="bar-label-top">{{ $candidate->votes_count }} ({{ $percent }}%)</span>
                        <div class="bar {{ $color }}" style="height: {{ $barHeight }}px;"></div>
                        <span class="bar-name">{{ $candidate->name }}<br>({{ $candidate->party }})</span>
                    </div>
                @endforeach
            </div>

            <p class="chart-footer">Total Valid Votes: <strong>{{ $totalVotes }}</strong></p>
        </div>

        <!-- DETAILED RESULTS TABLE -->
        <div class="table-section">
            <div class="table-header-row">
                <div class="section-title">
                    <i class="fa-solid fa-list"></i>
                    Detailed Results
                </div>
                <button class="refresh-btn" onclick="location.reload()">
                    <i class="fa-solid fa-rotate-right"></i> Refresh
                </button>
            </div>

            <div class="table-wrapper">
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Party Name</th>
                            <th>Party Symbol</th>
                            <th>Total Votes</th>
                            <th>Percentage</th>
                            <th>Status</th>
                            <th>Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidates as $index => $candidate)
                            @php
                                $percent = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 1) : 0;
                                $rank = $index + 1;
                            @endphp
                            <tr class="{{ $rank == 1 ? 'winner-row' : '' }}">
                                <td class="name-cell">
                                    <div style="width:38px;height:38px;border-radius:50%;background:#2541b2;color:white;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;">
                                        {{ strtoupper(substr($candidate->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $candidate->name }}</span>
                                </td>
                                <td>{{ $candidate->party }}</td>
                                <td><span class="table-symbol">{{ $candidate->symbol }}</span></td>
                                <td><strong>{{ $candidate->votes_count }}</strong></td>
                                <td>{{ $percent }}%</td>
                                <td>
                                    @if ($rank == 1 && $totalVotes > 0)
                                        <span class="result-badge badge-winner">Winner</span>
                                    @elseif ($rank == 2)
                                        <span class="result-badge badge-runnerup">Runner-up</span>
                                    @else
                                        <span class="result-badge badge-lost">Lost</span>
                                    @endif
                                </td>
                                <td class="rank-cell">{{ $rank == 1 ? '🏆 1' : $rank }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif

    <a href="{{ route('results.index') }}">Back to Elections List</a>

</div>

@endsection