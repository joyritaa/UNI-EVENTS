window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  if (window.scrollY > 50) {
      header.classList.add('scrolled');
  } else {
      header.classList.remove('scrolled');
  }
});

document.addEventListener("DOMContentLoaded", function () {
    
  // LOGIN FUNCTION
document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();
      let formData = new FormData(this);

      fetch("login.php", {
          method: "POST",
          body: formData,
      })
      .then(response => response.text())
      .then(data => {
          alert(data);
          if (data.includes("Login successful")) {
              window.location.href = "organizers.html";
          }
      })
      .catch(error => console.error("Error:", error));
  });
});




//submitting events
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("contactForm")?.addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("submit_event.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Show a success message
            window.location.reload(); // Refresh the page to see the new event
        })
        .catch(error => console.error("Error:", error));
    });

    // Function to load submitted events
    function loadEvents() {
        fetch("get_events.php")
        .then(response => response.json())
        .then(data => {
            let eventContainer = document.getElementById("event_details");
            if (eventContainer) {
                eventContainer.innerHTML = "";
                data.forEach(event => {
                    eventContainer.innerHTML += `
                        <div class="event-details">
    <div class="event-type">${event.event_type}</div>
    <h3>${event.title}</h3>
    <div class="event-info">
        <p><i class="fas fa-clock"></i> ${event.start_time} - ${event.end_time}</p>
        <p><i class="fas fa-map-marker-alt"></i> ${event.venue_id}</p>
    </div>
    <p class="event-description">${event_desc}</p>
    <div class="event-footer">
        <span class="price">$${event.price}</span>
        <button class="btn-small">RSVP</button>
    </div>`;
                });
            }
        })
        .catch(error => console.error("Error fetching events:", error));
    }

    loadEvents(); // Load events when the page loads
});

//reviews

document.addEventListener("DOMContentLoaded", function () {

    // SUBMIT A REVIEW
    document.getElementById("reviewForm")?.addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("reviews.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            loadReviews(formData.get("event_id")); // Refresh reviews
        })
        .catch(error => console.error("Error submitting review:", error));
    });

    // LOAD REVIEWS FOR AN EVENT
    function loadReviews(eventId) {
        fetch(`reviews.php?event_id=${eventId}`)
        .then(response => response.json())
        .then(data => {
            let reviewContainer = document.getElementById("reviews-container");
            if (reviewContainer) {
                reviewContainer.innerHTML = "";
                data.forEach(review => {
                    reviewContainer.innerHTML += `
                        <div class="review">
                            <p><strong>${review.username}</strong> rated <span class="rating">${"⭐".repeat(review.rating)}</span></p>
                            <p class="comment">${review.comment}</p>
                            <p class="date">${review.created_at}</p>
                        </div>`;
                });
            }
        })
        .catch(error => console.error("Error fetching reviews:", error));
    }

    // AUTO LOAD REVIEWS (Replace eventId with the actual event ID)
    let eventId = document.getElementById("reviewForm")?.dataset.eventId;
    if (eventId) {
        loadReviews(eventId);
    }
});
