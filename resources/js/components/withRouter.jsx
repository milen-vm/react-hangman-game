/**
 * Helper function to import route params in react class component.
 */
import { useParams } from 'react-router-dom';

const withRouter = WrappedComponent => props => {
    const params = useParams();

    return <WrappedComponent 
        { ...props }
        params={ params }
    />
};

export default withRouter;