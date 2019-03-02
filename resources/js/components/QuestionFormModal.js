import React, {Component} from "react";
import * as PropTypes from "prop-types";

const MULTIPLE_ANSWER = 'multiple_answer';
const SINGLE_ANSWER = 'single_answer';
const FREE_TEXT = 'free_text';
const NUMBERS = 'numbers';

const $ = window.$;

function Question() {
    this.type = FREE_TEXT;
    this.question = "";
    this.options = "";
    return this;
}

export class QuestionFormModal extends Component {
    constructor(props) {
        super(props);
        this.state = new Question()
    }

    componentDidMount() {
        this.$modal = $(this.modal);

        // Purge state when modal hides
        this.$modal.on('hidden.bs.modal', () => {
            this.setState(new Question())
        });

        this.$modal.on('shown.bs.modal', () => {
            this.nameField.focus();
        })
    }

    render() {
        return (
            <div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true" ref={instance => this.modal = instance}>
                <div className="modal-dialog" role="document">
                    <form className="modal-content" onSubmit={event => this.handleSubmit(event)}>
                        <div className="modal-header">
                            <h5 className="modal-title" id="exampleModalLabel">Add a question to your survey</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body p-md-5">
                            <div className="form-group">
                                <input type="text" className="form-control"
                                       placeholder="Type your question here"
                                       required={true}
                                       value={this.state.question}
                                       onChange={event => this.setState({question: event.target.value})}
                                       ref={instance => this.nameField = instance}
                                />
                            </div>
                            <div className="form-group">
                                <label htmlFor="questionType">What kind of answers do you expect for this
                                    question?</label>
                                <select className="form-control" value={this.state.type}
                                        onChange={e => this.setState({type: e.target.value})}
                                        required={true}
                                >
                                    <option value={FREE_TEXT}>Free text</option>
                                    <option value={NUMBERS}>Numbers</option>
                                    <option value={SINGLE_ANSWER}>Single answer</option>
                                    <option value={MULTIPLE_ANSWER}>Multiple answers</option>
                                </select>
                            </div>

                            {(this.state.type === MULTIPLE_ANSWER || this.state.type === SINGLE_ANSWER) && (
                                <div className="form-group">
                                    <label htmlFor="possibleAnswers">Provide possible answers</label>
                                    <textarea className="form-control" placeholder="Put each answer on a new line"
                                              rows={5}
                                              required={true}
                                              value={this.state.options}
                                              onChange={event => this.setState({options: event.target.value})}
                                    />
                                </div>
                            )}
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" className="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        );
    }

    handleSubmit(event) {
        event.preventDefault();
        this.props.onSubmit(this.state);
        this.$modal.modal('hide');
    }
}

QuestionFormModal.propTypes = {
    onSubmit: PropTypes.func.isRequired,
};
