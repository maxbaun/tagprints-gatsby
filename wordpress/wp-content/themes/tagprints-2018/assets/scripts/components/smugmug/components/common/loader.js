import React from 'react';

class Loader extends React.Component {
	render() {
		const style = {
			transform: 'scale(0.24)'
		};
		return (
			<div className="loading">
				<div className="loading-inner">
					<div className="loading-graphic" style={style}><div></div></div>
				</div>
			</div>
		);
	}
}

export default Loader;
