import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {QuestionFormModal} from "./QuestionFormModal";
import axios from "axios";

export class CreateSurvey extends Component {
    constructor(props) {
        super(props);
        this.state = {
            title: "",
            questions: []
        }
    }

    componentDidMount() {
        this.titleField.focus();
    }

    render() {
        return (
            <React.Fragment>
                <form className="py-4 py-lg-5" onSubmit={event => this.handleSubmit(event)}>
                    <div className="form-group">
                        <input type="text" className="form-control form-control-lg"
                               placeholder="Give your survey a title..."
                               value={this.state.title}
                               onChange={e => this.setState({title: e.target.value})}
                               ref={instance => this.titleField = instance}
                               required={true}
                        />
                    </div>
                    <div className="py-3">
                        <ul className="list-group list-group-flush">
                            {
                                this.state.questions.map((q, i) => (
                                    <li className="list-group-item align-items-center d-flex justify-content-between"
                                        key={`question-${i}`}>
                                        {q.question}
                                        <div className="btn-group btn-group-sm">
                                            <button type="button" className="btn btn-light">
                                                <i className="fa fa-pencil"/>
                                            </button>
                                            <button type="button" className="btn btn-light text-danger">
                                                <i className="fa fa-trash"/>
                                            </button>
                                        </div>
                                    </li>
                                ))
                            }
                            <li className="list-group-item">
                                <a href="#" data-toggle="modal"
                                   data-target="#exampleModal">+ {this.state.questions.length > 0 ? 'Add another question' : 'Add questions to this survey'}</a>
                            </li>
                        </ul>
                    </div>
                    <div className="text-center">
                        <button className="btn btn-success">Create Survey</button>
                    </div>
                </form>

                <QuestionFormModal
                    onSubmit={question => this.addQuestionToState(question)}
                />
            </React.Fragment>
        );
    }

    addQuestionToState(question) {
        const questions = this.state.questions;
        questions.push(question);
        this.setState({questions});
    }

    handleSubmit(e) {
        e.preventDefault();
        axios.post('/api/surveys', this.state)
            .then(res => console.log('Survey created!', res))
            .catch(err => alert('Could not create survey!'));
    }
}

if (document.getElementById('create-survey')) {
    ReactDOM.render(<CreateSurvey/>, document.getElementById('create-survey'));
}
