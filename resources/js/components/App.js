import React from 'react';
import ReactDOM from 'react-dom';
import Login from './Auth/LoginComponent/Login';
import DashboardNabar from './shares/layout/DashboardNabar';
import { ThemeProvider } from '@material-ui/core/styles';
import theme from './shares/theme';
import PostGrid from './app/post/PostGrid';

function App() {
    return (
        <ThemeProvider theme={theme}> 
             <div className="container">
                <div className="row justify-content-center">
                    <DashboardNabar/>
                    <PostGrid/>
                </div>
            </div>
            
        </ThemeProvider>
       
    );
}

export default App;

if (document.getElementById('root')) {
    ReactDOM.render(<App/>, document.getElementById('root'));
}
