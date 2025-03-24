// Function to format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    });
}

// Function to get status class
function getRandomStatus() {
    const statuses = ['pending', 'processing', 'completed', 'cancelled'];
    return statuses[Math.floor(Math.random() * statuses.length)];
}

// Initialize the dashboard
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for demo purposes
    console.log('hello jii');
    
    // Use try-catch to handle potential errors
    try {
        const navItems = document.querySelectorAll('.myntra-admin-nav-item');
        if (navItems && navItems.length > 0) {
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    const activeItem = document.querySelector('.myntra-admin-nav-item.active');
                    if (activeItem) {
                        activeItem.classList.remove('active');
                    }
                    this.classList.add('active');
                });
            });
        }
        
        const paginationItems = document.querySelectorAll('.myntra-admin-pagination-item');
        if (paginationItems && paginationItems.length > 0) {
            paginationItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (!this.classList.contains('active') && !this.querySelector('i')) {
                        const activeItem = document.querySelector('.myntra-admin-pagination-item.active');
                        if (activeItem) {
                            activeItem.classList.remove('active');
                        }
                        this.classList.add('active');
                    }
                });
            });
        }
    } catch (error) {
        console.error('Error initializing dashboard:', error);
    }
});