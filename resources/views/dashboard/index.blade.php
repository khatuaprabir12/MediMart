<x-adminheader />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    body {
margin: 0;
font-family: Arial, sans-serif;
background-color: #f8f9fa;
color: #333;
}

.dashboard-container {
display: flex;
height: 100vh;
}

/* Sidebar */
.sidebar {
width: 250px;
background-color: #f8f9fa;
color: white;
padding: 20px;
}

.sidebar h1 {
text-align: center;
margin-bottom: 30px;
}

.sidebar ul {
list-style: none;
padding: 0;
}

.sidebar ul li {
margin: 15px 0;
}

.sidebar ul li a {
color: white;
text-decoration: none;
font-size: 18px;
}

.sidebar ul li a:hover {
text-decoration: underline;
}

/* Main Content */
.main-content {
flex: 1;
padding: 20px;
}

.metrics {
display: flex;
gap: 20px;
margin-bottom: 30px;
}

.metric-card {
background-color: #27ae60;
color: white;
padding: 20px;
border-radius: 8px;
flex: 1;
text-align: center;
}

.charts {
display: flex;
gap: 20px;
margin-bottom: 30px;
}

.chart-container {
background: white;
padding: 20px;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
flex: 1;
}

.tables table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}

.tables table th, .tables table td {
padding: 10px;
border: 1px solid #ddd;
text-align: left;
}

.tables table th {
background-color: #27ae60;
color: white;
}
</style>
</head>
<body>


    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Metrics -->
        <section class="metrics">
            <div class="metric-card">
                <h2>Total Products</h2>
                <p class='display-5'>{{ $totalProducts }}</p>               
            </div>
            <div class="metric-card">
                <h2>Total Users</h2>
                <p class="display-5">{{ $totalUsers }}</p>
              
            </div>
            <div class="metric-card">
                <h2>Total Orders</h2>
                <p class="display-5">{{ $totalOrders }}</p>
                
            </div>
            <div class="metric-card">
                <h2>Total Revenue</h2>
                
            </div>
        </section>

        <!-- Graph Section -->
        <section class="charts">
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="ordersChart"></canvas>
            </div>
        </section>

        
    </main>
</div>

<script>
    // Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
type: 'line',
data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [{
        label: 'Revenue ($)',
        data: [1200, 1900, 3000, 5000, 2500, 4000],
        borderColor: '#27ae60',
        fill: false,
    }]
},
options: {
    responsive: true,
}
});

// Orders Chart
const ordersCtx = document.getElementById('ordersChart').getContext('2d');
new Chart(ordersCtx, {
type: 'bar',
data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [{
        label: 'Orders',
        data: [30, 50, 70, 100, 80, 90],
        backgroundColor: '#3498db',
    }]
},
options: {
    responsive: true,
}
});
</script>
</body>
</html>

         
<!-- content-wrapper ends -->
<x-adminfooter />