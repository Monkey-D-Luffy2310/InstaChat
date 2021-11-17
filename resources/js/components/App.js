import React from 'react';
import ReactDOM from 'react-dom';
import Login from './Auth/LoginComponent/Login';
import DashboardNabar from './shares/layout/DashboardNabar';

function App() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <DashboardNabar/>
            </div>
        </div>
    );
}

export default App;

if (document.getElementById('root')) {
    ReactDOM.render(<App/>, document.getElementById('root'));
}
