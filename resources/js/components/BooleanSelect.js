import React from "react";
import * as PropTypes from "prop-types";

export function BooleanSelect({label, id, value, onChange}) {
    return <div className="form-group">
        <label htmlFor={id}>{label}</label>
        <select id={id} className="form-control" value={value} onChange={e => onChange(e.target.value === 'true')}>
            <option value="false">No</option>
            <option value="true">Yes</option>
        </select>
    </div>;
}

BooleanSelect.propTypes = {
    label: PropTypes.string.isRequired,
    id: PropTypes.string.isRequired,
    value: PropTypes.bool.isRequired,
    onChange: PropTypes.func,
};
