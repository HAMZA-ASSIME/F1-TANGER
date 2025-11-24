import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import F1StartingLights from '../components/F1StartingLights';
import '../styles/Home.css';

function Home() {
  const navigate = useNavigate();
  const [loading, setLoading] = useState(true);
  const [drivers, setDrivers] = useState([]);

  useEffect(() => {
    // Show loader briefly when page loads
    const timer = setTimeout(() => {
      setLoading(false);
    }, 3000);

    return () => clearTimeout(timer);
  }, []);

  useEffect(() => {
    // Fetch top drivers from backend
    const fetchTopDrivers = async () => {
      try {
        const response = await fetch('http://localhost:8000/api/drivers/top-drivers');
        if (response.ok) {
          const data = await response.json();
          setDrivers(data);
        }
      } catch (error) {
        console.error('Error fetching drivers:', error);
      }
    };

    fetchTopDrivers();
  }, []);

  const raceResults = [
    {
      position: 1,
      driver: 'Max Verstappen',
      team: 'Red Bull Racing',
      time: '1:32:45.123'
    },
    {
      position: 2,
      driver: 'Lewis Hamilton',
      team: 'Mercedes',
      time: '+2.5s'
    },
    {
      position: 3,
      driver: 'Charles Leclerc',
      team: 'Ferrari',
      time: '+8.2s'
    }
  ];

  const teams = [
    { id: 1, name: 'Red Bull Racing', color: '#0082FA' },
    { id: 2, name: 'Mercedes', color: '#00D2BE' },
    { id: 3, name: 'Ferrari', color: '#DC0000' },
    { id: 4, name: 'McLaren', color: '#FF8700' },
    { id: 5, name: 'Alpine', color: '#0082FA' },
    { id: 6, name: 'Aston Martin', color: '#006C3D' }
  ];

  const news = [
    {
      id: 1,
      title: 'Verstappen Dominates Sprint Race',
      date: 'Nov 24, 2025',
      description: 'Red Bull driver secures pole position'
    },
    {
      id: 2,
      title: 'Hamilton Eyes Championship',
      date: 'Nov 23, 2025',
      description: 'Mercedes legend pushes for victory'
    },
    {
      id: 3,
      title: 'Leclerc Shows Strong Pace',
      date: 'Nov 22, 2025',
      description: 'Ferrari competitive in qualifying'
    },
    {
      id: 4,
      title: 'New Track Records Set',
      date: 'Nov 21, 2025',
      description: 'Multiple drivers break lap records'
    }
  ];

  return (
    <div className="home-page">
      {/* Loader */}
      <F1StartingLights isLoading={loading} />

      {/* HERO SECTION WITH VIDEO */}
      <section className="hero-section">
        <video 
          className="hero-video" 
          autoPlay 
          muted 
          loop 
          playsInline
        >
          <source src="/store/videos/bg-video.mp4" type="video/mp4" />
        </video>
        <div className="hero-overlay"></div>
        
        <div className="hero-content">
          <h1 className="hero-title">Feel The Speed of Formula 1</h1>
          <p className="hero-subtitle">Live Results, Teams, Drivers, and Stats</p>
          <button className="hero-cta" onClick={() => navigate('/register')}>
            Explore Now
          </button>
        </div>
      </section>

      {/* LATEST RACE RESULTS */}
      <section className="results-section">
        <div className="section-wrapper">
          <h2 className="section-title">Latest Race Results</h2>
          <div className="results-grid">
            {raceResults.map((result) => (
              <div key={result.position} className="result-card">
                <div className="position-badge">{result.position}</div>
                <h3 className="driver-name">{result.driver}</h3>
                <p className="team-name">{result.team}</p>
                <p className="race-time">{result.time}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* TEAMS SECTION */}
      <section className="teams-section">
        <div className="section-wrapper">
          <h2 className="section-title">F1 Teams</h2>
          <div className="teams-grid">
            {teams.map((team) => (
              <div key={team.id} className="team-card" style={{ '--team-color': team.color }}>
                <div className="team-color-bar"></div>
                <h3 className="team-name">{team.name}</h3>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* DRIVERS SECTION */}
      <section className="drivers-section">
        <div className="section-wrapper">
          <h2 className="section-title">Top Drivers</h2>
          <div className="drivers-grid">
            {drivers.map((driver) => (
              <div key={driver.id} className="driver-card">
                <div className="driver-avatar">
                  {driver.driver_img ? (
                    <img src={`http://localhost:8000/${driver.driver_img}`} alt={driver.first_name} />
                  ) : (
                    <div className="avatar-placeholder"></div>
                  )}
                </div>
                <h3 className="driver-name">{driver.first_name} {driver.last_name}</h3>
                <p className="driver-team">{driver.team?.name || 'N/A'}</p>
                <p className="driver-points">{driver.total_points} pts</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* NEWS SECTION */}
      <section className="news-section">
        <div className="section-wrapper">
          <h2 className="section-title">Latest News</h2>
          <div className="news-scroll">
            {news.map((article) => (
              <div key={article.id} className="news-card">
                <div className="news-image"></div>
                <h3 className="news-title">{article.title}</h3>
                <p className="news-date">{article.date}</p>
                <p className="news-description">{article.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* FOOTER */}
      <footer className="f1-footer">
        <div className="footer-content">
          <div className="footer-logo">F1 TANGER</div>
          <p className="footer-copyright">&copy; 2025 Formula 1 Tanger. All rights reserved.</p>
        </div>
      </footer>
    </div>
  );
}

export default Home;
